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
    public function update($id, array $changes)
    {
        return $this->http->put($this->api_url . '/items/' . $id, ['access_token' => $this->app->getAccessToken()], $changes);
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
     * Refresh the App instance.
     *
     * @return void
     */
    public function refreshApp($app)
    {
        $this->app = $app;
    }
}
