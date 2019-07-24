<?php
namespace Braghetto\Hokoml;

/**
* Shipping
*/

class Shipping implements AppRefreshableInterface
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
     * Get data from a shipment.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function find($id)
    {
        return $this->http->get($this->app->getApiUrl("/shipments/{$id}"));
    }

    /**
     * Get a list of available shipping methods.
     *
     * @param string $country
     * @return array with body and http_code keys.
     */
    public function methods(string $country = null)
    {
        $country = empty($country) ? $this->app->getCountry() : $country;
        return $this->http->get($this->app->getApiUrl("/sites/{$country}/shipping_methods"));
    }

    /**
     * Get a list of available shipping methods for a product (Custom shipping only).
     *
     * @param $id
     * @return array with body and http_code keys.
     */
    public function options($id)
    {
        return $this->http->get($this->app->getApiUrl("/items/{$id}/shipping_options"));
    }

    /**
     * Get a list of available shipping methods for a product (Custom shipping only).
     *
     * @param $from zip_code from
     * @param $to zip_code destination
     * @param $dimensions product dimensions LengthxWidthxHeight,Weigth
     * @param string $country
     * @return array with body and http_code keys.
     * @example $hokoml->shipping()->cost(5000, 6000, 10x10x20,500)
     */
    public function cost($from, $to, $dimensions, $country = null)
    {
        $country = empty($country) ? $this->app->getCountry() : $country;
        return $this->http->get($this->app->getApiUrl("/sites/{$country}/shipping_options"), [
            'zip_code_from' => $from,
            'zip_code_to' => $to,
            'dimensions' => $dimensions,
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
}
