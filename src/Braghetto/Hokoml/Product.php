<?php
namespace Braghetto\Hokoml;

/**
* Product
*/

class Product implements AppRefreshableInterface
{
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
        'deleted',
        'attributes',
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
    }

    /**
     * Validates the data.
     *
     * @param array $data
     * @return array with body and http_code keys.
     */
    public function validate(array $data)
    {
        return $this->http->post($this->app->getApiUrl('/items/validate'), ['access_token' => $this->app->getAccessToken()], $data);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return array with body and http_code keys.
     */
    public function create(array $data)
    {
        return $this->http->post($this->app->getApiUrl('/items'), ['access_token' => $this->app->getAccessToken()], $data);
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
                $descriptionResponse = $this->updateDescription($id, $changes['description']);
                unset($changes['description']);
                if ($descriptionResponse['http_code'] !== 200 || empty($changes)) {
                    return $descriptionResponse;
                }
            }
        }
        $response = $this->http->put($this->app->getApiUrl("/items/{$id}"), ['access_token' => $this->app->getAccessToken()], $changes);
        if ($response['http_code'] !== 200) {
            return $response;
        }
        if (isset($descriptionResponse)) {
            $response['body']['descriptions']['plain_text'] = $descriptionResponse['body']['plain_text'];
        }
        return $response;
    }

    /**
     * Update a product price.
     *
     * @param string $id
     * @param float $price
     * @return array with body and http_code keys.
     */
    public function updatePrice(string $id, float $price)
    {
        $response = $this->find($id);
        if ($response['http_code'] !== 200) {
            return $response;
        }
        $product = $response['body'];
        $data = [];
        if (empty($product['variations'])) {
            $data = ['price' => $price];
        } else {
            $data = ['variations' => []];
            foreach ($product['variations'] as $variation) {
                $data['variations'][] = [
                    'id' => $variation['id'],
                    'price' => $price,
                ];
            }
        }
        return $this->update($id, $data);
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
        return $this->http->put($this->app->getApiUrl("/items/{$id}/description"), ['access_token' => $this->app->getAccessToken()], $description);
    }

    // /**
    //  * Update a product.
    //  *
    //  * @param string $id
    //  * @param array $changes
    //  * @return array with body and http_code keys.
    //  */
    // public function updateVariation($id, $product_id, array $changes)
    // {
    //     $url = $this->api_url . '/items/' . $product_id . '/variations/' . $id;
    //     return $this->http->put($url, ['access_token' => $this->app->getAccessToken()], $changes);
    // }

    /**
     * Search for a product.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function find($id)
    {
        return $this->http->get($this->app->getApiUrl("/items/{$id}"), ['access_token' => $this->app->getAccessToken()]);
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
        return $this->http->post($this->app->getApiUrl("/items/{$id}/relist"), ['access_token' => $this->app->getAccessToken()], [
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
     * Search for products.
     *
     * @param array $filters
     * @return array with body and http_code keys.
     */
    public function search(array $filters)
    {
        return $this->http->get($this->app->getApiUrl('/sites/' . $this->getCountry() . '/search'), $filters);
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
}
