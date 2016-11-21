<?php
namespace Braghetto\Hokoml;

/**
* User
*/

class User implements UserInterface, AppRefreshableInterface
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
        $this->api_url = $this->app->getApiUrl();
    }

    /**
     * Get the authenticated user data.
     *
     * @return array
     */
    public function me()
    {
        return $this->http->get($this->api_url . '/users/me', ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Find a user by id
     *
     * @param string $user_id
     * @return array
     */
    public function find($user_id = null)
    {
        return $this->http->get($this->api_url . '/users/' . $user_id, ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Get the authenticated user addresses.
     *
     * @return array
     */
    public function addresses()
    {
        return $this->http->get($this->api_url . '/users/' . $this->app->getSellerId() . '/addresses', ['access_token' => $this->app->getAccessToken()]);
    }

    /**
     * Get the authenticated user accepted payment methods.
     *
     * @return array
     */
    public function acceptedPaymentMethods()
    {
        return $this->http->get($this->api_url . '/users/' . $this->app->getSellerId() . '/accepted_payment_methods', ['access_token' => $this->app->getAccessToken()]);
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
