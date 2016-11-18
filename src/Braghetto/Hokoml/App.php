<?php
namespace Braghetto\Hokoml;

/**
* App
*/

class App implements AppInterface
{
    /**
     * The api address.
     *
     * @var string
     */
    private $api_url = "https://api.mercadolibre.com";

    /**
     * The api auth address for each country.
     *
     * @var array
     */
    private $auth_urls = [
        "mla" => "https://auth.mercadolibre.com.ar",
        "mlb" => "https://auth.mercadolivre.com.br",
        "mco" => "https://auth.mercadolibre.com.co",
        "mcr" => "https://auth.mercadolibre.com.cr",
        "mec" => "https://auth.mercadolibre.com.ec",
        "mlc" => "https://auth.mercadolibre.cl",
        "mlm" => "https://auth.mercadolibre.com.mx",
        "mlu" => "https://auth.mercadolibre.com.uy",
        "mlv" => "https://auth.mercadolibre.com.ve",
        "mpa" => "https://auth.mercadolibre.com.pa",
        "mpe" => "https://auth.mercadolibre.com.pe",
        "mpt" => "https://auth.mercadolibre.com.pt",
        "mrd" => "https://auth.mercadolibre.com.do"
    ];

    /**
     * The user app id.
     * to retrive your app id access (http://applications.mercadolibre.com/).
     *
     * @var string
     */
    private $app_id;

    /**
     * The user secret key.
     * to retrive your secret key access (http://applications.mercadolibre.com/).
     *
     * @var string
     */
    private $secret_key;

    /**
     * The user selected country.
     *
     * @var string
     */
    private $country;

    /**
     * The redirect uri.
     * to set and retrive your redirect uri access (http://applications.mercadolibre.com/).
     *
     * @var string
     */
    private $redirect_uri;

    /**
     * The access token.
     *
     * @var string
     */
    private $access_token;

    /**
     * The user id.
     *
     * @var string
     */
    private $seller_id;

    /**
     * The http client.
     *
     * @var \Braghetto\Hokoml\HttpClientInterface
     */
    private $http;

    /**
     * Create a new \Braghetto\Hokoml\App instance.
     *
     * @param \Braghetto\Hokoml\HttpClientInterface $http_client
     * @param string $app_id
     * @param string $secret_key
     * @param string $country
     * @param string $redirect_uri
     * @param string $access_token
     * @param string $seller_id
     * @return void
     */
    public function __construct(HttpClientInterface $http_client, $app_id, $secret_key, $country, $redirect_uri, $access_token = null, $seller_id = null)
    {
        $this->http = $http_client;
        $this->app_id = $app_id;
        $this->secret_key = $secret_key;
        $this->country = strtolower($country);
        $this->redirect_uri = $redirect_uri;
        $this->access_token = $access_token;
        $this->seller_id = $seller_id;
    }

    /**
     * Return the auth url based on the selected country.
     *
     * @return string
     */
    public function getAuthUrl($redirect_uri = null)
    {
        $params = [
            'client_id' => $this->app_id,
            'response_type' => 'code',
            'redirect_uri' => isset($redirect_uri) ? $redirect_uri : $this->redirect_uri,

        ];
        return $this->auth_urls[$this->country] . '/authorization?' . http_build_query($params);
    }

    /**
     * Return an associative array with body and code keys.
     *
     * @return array
     */
    public function authorize($code)
    {
        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->app_id,
            'client_secret' => $this->secret_key,
            'code' => $code,
            'redirect_uri' => $this->redirect_uri
        ];
        $response = $this->http->post($this->api_url . '/oauth/token?' . http_build_query($data));
        $this->resetAccessTokenAndSellerId($response);
        return $response;
    }

    /**
     * Return an associative array with body and code keys.
     *
     * @return array
     */
    public function refreshAccessToken($refresh_token)
    {
        $data = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->app_id,
            'client_secret' => $this->secret_key,
            'refresh_token' => $refresh_token
        ];
        $response = $this->http->post($this->api_url . '/oauth/token', $data);
        $this->resetAccessTokenAndSellerId($response);
        return $response;
    }

    /**
     * Reset the access token and seller id.
     *
     * @return array
     */
    private function resetAccessTokenAndSellerId($response)
    {
        if ($response['http_code'] === 200) {
            $this->access_token = $response['body']['access_token'];
            $this->seller_id = $response['body']['seller_id'];
        }
    }

    /**
     * Return the country code.
     *
     * @return string
     */
    public function getCountry()
    {
        return strtoupper($this->country);
    }

    /**
     * Return the api address.
     *
     * @return string
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * Set a new access token.
     *
     * @return void
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Return the access token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Set a new user id.
     *
     * @return void
     */
    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;
    }

    /**
     * Return the user id.
     *
     * @return string
     */
    public function getSellerId()
    {
        return $this->seller_id;
    }
}
