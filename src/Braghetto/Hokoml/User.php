<?php
namespace Braghetto\Hokoml;

/**
* User
*/

class User implements AppRefreshableInterface
{

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
     * Create a new \Braghetto\Hokoml\User instance.
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
     * Get the authenticated user data.
     *
     * @return array
     */
    public function me()
    {
        return $this->http->get($this->app->getApiUrl('/users/me'), ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Find a user by id
     *
     * @param string $user_id
     * @return array
     */
    public function find($user_id = null)
    {
        return $this->http->get($this->app->getApiUrl("/users/$user_id"), ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Get the authenticated user addresses.
     *
     * @return array
     */
    public function addresses()
    {
        return $this->http->get($this->app->getApiUrl('/users/' . $this->app->getSellerId() . '/addresses'), ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Get the authenticated user accepted payment methods.
     *
     * @return array
     */
    public function acceptedPaymentMethods()
    {
        return $this->http->get($this->app->getApiUrl('/users/' . $this->app->getSellerId() . '/accepted_payment_methods'), ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Get products from account
     *
     * @param array $filters
     * @return array with body and http_code keys.
     */
    public function products($seller_id = null, array $filters = [])
    {
        $seller_id = isset($seller_id) ? $seller_id : $this->app->getSellerId();
        $filters = array_merge($filters, ['access_token' => $this->app->getAccessToken()]);
        return $this->http->get($this->app->getApiUrl("/users/$seller_id/items/search"), $filters);
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
