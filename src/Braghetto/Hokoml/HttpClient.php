<?php
namespace Braghetto\Hokoml;

/**
* HttpClient
*/

class HttpClient implements HttpClientInterface
{
    /**
     * Curl common options to all requests.
     *
     * @var array
     */
    private $common_curl_ops = [
        CURLOPT_USERAGENT => "HOKOML",
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ];

    /**
     * Determine if the json resposes will be parsed to arrays.
     *
     * @var boolean
     */
    private $response_as_array;

    /**
     * Create a new \Braghetto\Hokoml\HttpClient instance.
     *
     * @param boolean $production
     * @param boolean $response_as_array
     * @return void
     */
    public function __construct($production = true, $response_as_array = true)
    {
        $this->common_curl_ops[CURLOPT_SSL_VERIFYPEER] = $production;
        // $this->common_curl_ops[CURLOPT_VERBOSE] = !$production;
        $this->response_as_array = $response_as_array;
    }

    /**
     * Perform a request.
     *
     * @param string $method
     * @param string $uri
     * @param array $extra_curl_ops curl options that will be merged to the $common_curl_ops
     * @return array with body and http_code keys.
     */
    public function request($method, $uri, array $extra_curl_ops = [])
    {
        $ops = $this->common_curl_ops;
        if (!empty($extra_curl_ops)) {
            $ops = $this->common_curl_ops + $extra_curl_ops;
        }
        $curl = curl_init($uri);
        curl_setopt_array($curl, $ops);
        $body = json_decode(curl_exec($curl), $this->response_as_array);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return [
            'http_code' => $http_code,
            'body' => $body
        ];
    }

    /**
     * Perform a GET request.
     *
     * @param string $uri
     * @param array $params
     * @return array with body and http_code keys.
     */
    public function get($uri, array $params = [])
    {
        if (!empty($params)) {
            $uri .= '?' . http_build_query($params);
        }
        return $this->request('get', $uri);
    }

    /**
     * Perform a POST request.
     *
     * @param string $uri
     * @param array $params
     * @param array $body
     * @return array with body and http_code keys.
     */
    public function post($uri, array $params = [], array $body = [])
    {
        $extra_curl_ops = [
            CURLOPT_POST => true,
        ];
        if (!empty($params)) {
            $uri .= '?' . http_build_query($params);
        }
        if (!empty($body)) {
            $extra_curl_ops[CURLOPT_POSTFIELDS] = json_encode($body);
        }
        return $this->request('post', $uri, $extra_curl_ops);
    }

    /**
     * Perform a PUT request.
     *
     * @param string $uri
     * @param array $params
     * @param array $body
     * @return array with body and http_code keys.
     */
    public function put($uri, array $params = [], array $body = [])
    {
        $extra_curl_ops = [
            CURLOPT_CUSTOMREQUEST => 'PUT',
        ];
        if (!empty($params)) {
            $uri .= '?' . http_build_query($params);
        }
        if (!empty($body)) {
            $extra_curl_ops[CURLOPT_POSTFIELDS] = json_encode($body);
        }
        return $this->request('post', $uri, $extra_curl_ops);
    }

    /**
     * Perform a DELETE request.
     *
     * @param string $uri
     * @param array $params
     * @param array $body
     * @return array with body and http_code keys.
     */
    public function delete($uri, array $params = [], array $body = [])
    {
        $extra_curl_ops = [
            CURLOPT_CUSTOMREQUEST => 'DELETE'
        ];
        if (!empty($params)) {
            $uri .= '?' . http_build_query($params);
        }
        if (!empty($body)) {
            $extra_curl_ops[CURLOPT_POSTFIELDS] = json_encode($body);
        }
        return $this->request('delete', $uri, $extra_curl_ops);
    }
}
