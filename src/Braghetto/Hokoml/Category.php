<?php
namespace Braghetto\Hokoml;

/**
* Category
*/

class Category implements CategoryInterface, AppRefreshableInterface
{
    /**
     * The http client.
     *
     * @var \Braghetto\Hokoml\HttpClientInterface
     */
    private $api_url;

    /**
     * An App instance.
     *
     * @var \Braghetto\Hokoml\AppInterface
     */
    private $app;

    /**
     * The http client.
     *
     * @var \Braghetto\Hokoml\HttpClientInterface
     */
    private $http;

    /**
     * Create a new \Braghetto\Hokoml\Category instance.
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
     * Get a list of categories from Mercado livre. If a category id is sent as
     * param the method returns subcategories.
     *
     * @param string $category_id
     * @return array
     */
    public function list($category_id = null)
    {
        $qurl = $this->api_url;
        $qurl .= isset($category_id) ? '/categories/' . $category_id : '/sites/' . $this->app->getCountry() . '/categories';
        return $this->http->get($qurl);
    }

    /**
     * Return a Mercado livre category prediction based on the title.
     *
     * @param string $title
     * @return array
     */
    public function predict($title)
    {
        return $this->http->get($this->api_url . '/sites/' . $this->app->getCountry() . '/category_predictor/predict', [
            'title' => $title
        ]);
    }

    /**
     * Return a Mercado livre category prediction based on the title.
     *
     * @param string $title
     * @return array
     */
    public function attributes($category_id)
    {
        return $this->http->get($this->api_url . '/categories/' . $category_id . '/attributes');
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
