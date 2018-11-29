<?php
namespace Braghetto\Hokoml;

/**
* Product
*/

class Product implements ProductInterface, AppRefreshableInterface
{
    /**
     * The api base url.
     *
     * @var string
     */
    private $api_url;

    /**
     * The http client.
     *
     * @var \Braghetto\Hokoml\HttpClientInterface
     */
    private $http;

    /**
     * An App instance.
     *
     * @var \Braghetto\Hokoml\AppInterface
     */
    private $app;

    /**
     * Allowed fileds to update.
     *
     * @var array
     */
    private $allowed_changes = [
        'title',
        'available_quantity',
        'price',
        'video',
        'pictures',
        'description',
        'shipping',
        'variations',
        'status',
    ];

    /**
     * Create a new \Braghetto\Hokoml\Product instance.
     *
     * @param \Braghetto\Hokoml\HttpClientInterface $http_client
     * @param \Braghetto\Hokoml\AppInterface $app
     * @return void
     */
    public function __construct(HttpClientInterface $http_client, AppInterface $app)
    {
        $this->http = $http_client;
        $this->app = $app;
        $this->api_url = $this->app->getApiUrl();
    }

    /**
     * Create a new product.
     *
     * @param array $item
     * @return array with body and http_code keys.
     */
    public function create(array $item)
    {
        return $this->http->post($this->api_url . '/items', ['access_token' => $this->app->getAccessToken()], $item);
    }

    /**
     * Update a product.
     *
     * @param string $id
     * @param array $changes
     * @return array with body and http_code keys.
     */
    public function update($id, array $changes, $filterChanges = true)
    {
        if ($filterChanges) {
            $changes = array_intersect_key($changes, array_flip($this->allowed_changes));

            if (isset($changes['description'])) {
                $resp = $this->updateDescription($id, ['description' => $changes['description']]);
                unset($changes['description']);
                if ($resp['http_code'] !== 200) {
                    return $resp;
                }
            }

            $changes = $this->stripeNotModifiableFields($changes);
        }

        return $this->http->put($this->api_url . '/items/' . $id, ['access_token' => $this->app->getAccessToken()], $changes);
    }

    /**
     * Update a product description.
     *
     * @param string $id
     * @param array $description
     * @return array with body and http_code keys.
     */
    public function updateDescription(string $id, array $description)
    {
        return $this->http->put($this->api_url . '/items/' . $id . '/description', ['access_token' => $this->app->getAccessToken()], $description);
    }

    /**
     * Update a product.
     *
     * @param string $id
     * @param array $changes
     * @return array with body and http_code keys.
     */
    public function updateVariation($id, $product_id, array $changes)
    {
        $url = $this->api_url . '/items/' . $product_id . '/variations/' . $id;
        return $this->http->put($url, ['access_token' => $this->app->getAccessToken()], $changes);
    }

    /**
     * Search for a product.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function find($id)
    {
        return $this->http->get($this->api_url . '/items/' . $id, ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Pause a active product.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function pause($id)
    {
        return $this->update($id, [
            'status' => 'paused'
        ]);
    }

    /**
     * Unpause a paused product.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function unpause($id)
    {
        return $this->update($id, [
            'status' => 'active'
        ]);
    }

    /**
     * Finalize active|paused product.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function finalize($id)
    {
        return $this->update($id, [
            'status' => 'closed'
        ]);
    }

    /**
     * Relist finalized products.
     *
     * @param string $id
     * @param float $price
     * @param int $quantity
     * @param string $listing_type access https://api.mercadolibre.com/sites/MLB/listing_types to get a list.
     * @return array with body and http_code keys.
     */
    public function relist($id, $price, $quantity = 1, $listing_type = 'free')
    {
        return $this->http->post($this->api_url . '/items/' . $id . '/relist', ['access_token' => $this->app->getAccessToken()], [
            'price' => $price,
            'quantity' => $quantity,
            'listing_type_id' => $listing_type,
        ]);
    }

    /**
     * Delete a finalized product.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function delete($id)
    {
        return $this->update($id, [
            'deleted' => true
        ]);
    }

    /**
     * Get a list of Mercado livre listing types.
     *
     * @return array with body and http_code keys.
     */

    public function listingTypes()
    {
        return $this->http->get($this->api_url . '/sites/' . $this->app->getCountry() . '/listing_types');
    }

    /**
     * Update the variations of a product.
     *
     * @param string $id
     * @param array $variations
     * @return array with body and http_code keys.
     */

    public function updateVariations($id, array $variations)
    {
        return $this->http->put($this->api_url . '/items/' . $id, ['access_token' => $this->app->getAccessToken()], [
            'variations' => $variations
        ]);
    }

    /**
     * Refresh the App instance.
     *
     * @return void
     */
    public function refreshApp($app)
    {
        $this->app = $app;
    }

    /**
     * Strie unecessary|not modifiable fields
     *
     * @return array $data
     */
    private function stripeNotModifiableFields($changes)
    {
        if (isset($changes['variations'])) {
            if (isset($changes['available_quantity'])) {
                unset($changes['available_quantity']);
            }
            if (isset($changes['price'])) {
                unset($changes['price']);
            }
        }

        if (isset($changes['shipping'])) {
            if (isset($changes['shipping']['tags'])) {
                unset($changes['shipping']['tags']);
            }
            if (empty($changes['shipping']['dimensions'])) {
                unset($changes['shipping']['dimensions']);
            }
        }
        return $changes;
    }
}
