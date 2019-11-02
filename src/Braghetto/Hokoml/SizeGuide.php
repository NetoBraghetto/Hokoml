<?php
namespace Braghetto\Hokoml;

/**
* SizeGuide
*/

class SizeGuide implements AppRefreshableInterface
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
     * Retrive a size guide by id.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function find($id)
    {
        return $this->http->get($this->app->getApiUrl("/size_charts/$id"), ['access_token' => $this->app->getAccessToken()]);
    }
    
    /**
     * Get a list of measurements atributes
     *
     * @return array with body and http_code keys.
     */
    public function get()
    {
        return $this->http->get($this->app->getApiUrl('/size_charts'), [
            'access_token' => $this->app->getAccessToken()
        ]);
    }

    /**
     * Create a new size guide.
     *
     * @param array $data
     * @return array with body and http_code keys.
     */
    public function create(array $data)
    {
        return $this->http->post(
            $this->app->getApiUrl('/size_charts'),
            ['access_token' => $this->app->getAccessToken()],
            $data
        );
    }

    /**
     * Update a existing size guide.
     *
     * @param string $id
     * @param array $data
     * @return array with body and http_code keys.
     */
    public function update($id, array $data)
    {
        return $this->http->put(
            $this->app->getApiUrl("/size_charts/$id"),
            ['access_token' => $this->app->getAccessToken()],
            $data
        );
    }

    /**
     * Delete a existing size guide.
     *
     * @param string $id
     * @return array with body and http_code keys.
     */
    public function delete($id)
    {
        return $this->http->delete(
            $this->app->getApiUrl("/size_charts/$id"),
            ['access_token' => $this->app->getAccessToken()]
        );
    }
    
    /**
     * Get a list of measurements atributes
     *
     * @param string $country
     * @return array
     */
    public function getMeasurementAttributes($country = null)
    {
        if (is_null($country)) {
            $country = $this->app->getCountry();
        }
        
        return $this->http->get($this->app->getApiUrl('/size_charts/measurements'), [
            'site_id' => $country
        ]);
    }
    
    /**
     * Get a list of items associated to the size guide
     *
     * @param string $id
     * @return array
     */
    public function getAssociatedItems($id)
    {
        return $this->http->get($this->app->getApiUrl("/size_charts/$id/items"), ['access_token' => $this->app->getAccessToken()]);
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
