<?php
namespace Braghetto\Hokoml;

use Braghetto\Hokoml\App;
use Braghetto\Hokoml\Product;
use Braghetto\Hokoml\Question;
use Braghetto\Hokoml\HttpClient;

/**
* Hokoml
*/

class Hokoml
{
    /**
     * The user configurations.
     *
     * @var array
     */
    private $config;

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
     * A Product instance.
     *
     * @var \Braghetto\Hokoml\ProductInterface
     */
    private $product;

    /**
     * A Question instance.
     *
     * @var \Braghetto\Hokoml\QuestionInterface
     */
    private $question;

    /**
     * A User instance.
     *
     * @var \Braghetto\Hokoml\UserInterface
     */
    private $user;

    /**
     * Create a new \Braghetto\Hokoml\Hokoml instance.
     *
     * @param array $config
     * @param string $access_token
     * @param string $seller_id
     * @return void
     */
    public function __construct(array $config, $access_token = null, $seller_id = null)
    {
        $this->config = $config;
        $this->http = new HttpClient($this->config['production']);
        $this->app = new App($this->http, $this->config['app_id'], $this->config['secret_key'], $this->config['country'], $this->config['redirect_uri'], $access_token, $seller_id);
    }

    /**
     * Return an associative array with body and code keys.
     *
     * @return array
     */
    public function authorize($code)
    {
        $response =  $this->app->authorize($code);
        $this->resetAppInstance();
        return $response;
    }

    /**
     * Return an associative array with body and code keys.
     *
     * @return array
     */
    public function refreshAccessToken($refresh_token)
    {
        $response = $this->app->refreshAccessToken($refresh_token);
        $this->resetAppInstance();
        return $response;
    }

    /**
     * Return the auth url based on the selected country.
     *
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->app->getAuthUrl();
    }

    /**
     * Reset the App instances.
     *
     * @return void
     */
    private function resetAppInstance()
    {
        if (isset($this->product)) {
            $this->product->refreshApp($this->app);
        }
        if (isset($this->question)) {
            $this->question->refreshApp($this->app);
        }
        if (isset($this->user)) {
            $this->user->refreshApp($this->app);
        }
    }

    /**
     * Return an App instance.
     *
     * @return \Braghetto\Hokoml\ProductInterface
     */
    public function app()
    {
        return $this->app;
    }

    /**
     * Return a Product instance.
     *
     * @return \Braghetto\Hokoml\ProductInterface
     */
    public function product()
    {
        if (!isset($this->product)) {
            $this->product = new Product($this->http, $this->app);
        }
        return $this->product;
    }

    /**
     * Return a Question instance.
     *
     * @return \Braghetto\Hokoml\QuestionInterface
     */
    public function question()
    {
        if (!isset($this->question)) {
            $this->question = new Question($this->http, $this->app);
        }
        return $this->question;
    }

    /**
     * Return an User instance.
     *
     * @return \Braghetto\Hokoml\UserInterface
     */
    public function user()
    {
        if (!isset($this->user)) {
            $this->user = new User($this->http, $this->app);
        }
        return $this->user;
    }

    /**
     * Set a new access token to the App instance.
     *
     * @return void
     */
    public function setAccessToken($access_token)
    {
        $this->app->setAccessToken($access_token);
    }

    /**
     * Set a new user id to the App instance.
     *
     * @return void
     */
    public function setSellerId($seller_id)
    {
        $this->app->setSellerId($seller_id);
    }
}
