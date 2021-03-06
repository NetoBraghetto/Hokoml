<?php
namespace Braghetto\Hokoml;

use Braghetto\Hokoml\App;
use Braghetto\Hokoml\Product;
use Braghetto\Hokoml\Question;
use Braghetto\Hokoml\Order;
use Braghetto\Hokoml\HttpClient;
use Braghetto\Hokoml\SizeGuide;

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
     * Map of instances.
     *
     * @var array
     */
    private $instacesMap = [];

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
     * @var \Braghetto\Hokoml\Product
     */
    private $product;

    /**
     * A Question instance.
     *
     * @var \Braghetto\Hokoml\Question
     */
    private $question;

    /**
     * A User instance.
     *
     * @var \Braghetto\Hokoml\UserInterface
     */
    private $user;

    /**
     * A Order instance.
     *
     * @var \Braghetto\Hokoml\Order
     */
    private $order;

    /**
     * A Shipping instance.
     *
     * @var \Braghetto\Hokoml\Shipping
     */
    private $shipping;

    /**
     * A SizeGuide instance.
     *
     * @var \Braghetto\Hokoml\SizeGuide
     */
    private $sizeGuide;

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
        foreach ($this->instacesMap as $instanceName) {
            $this->$instanceName->refreshApp($this->app);
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
            $this->instacesMap[] = 'product';
        }
        return $this->product;
    }

    /**
     * Return a Question instance.
     *
     * @return \Braghetto\Hokoml\Question
     */
    public function question()
    {
        if (!isset($this->question)) {
            $this->question = new Question($this->http, $this->app);
            $this->instacesMap[] = 'question';
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
            $this->instacesMap[] = 'user';
        }
        return $this->user;
    }

    /**
     * Return an Order instance.
     *
     * @return \Braghetto\Hokoml\Order
     */
    public function order()
    {
        if (!isset($this->order)) {
            $this->order = new Order($this->http, $this->app);
            $this->instacesMap[] = 'order';
        }
        return $this->order;
    }

    /**
     * Return an Shipping instance.
     *
     * @return \Braghetto\Hokoml\Shipping
     */
    public function shipping()
    {
        if (!isset($this->shipping)) {
            $this->shipping = new Shipping($this->http, $this->app);
            $this->instacesMap[] = 'shipping';
        }
        return $this->shipping;
    }

    /**
     * Return an SizeGuide instance.
     *
     * @return \Braghetto\Hokoml\SizeGuide
     */
    public function sizeGuide()
    {
        if (!isset($this->sizeGuide)) {
            $this->sizeGuide = new SizeGuide($this->http, $this->app);
            $this->instacesMap[] = 'sizeGuide';
        }
        return $this->sizeGuide;
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
