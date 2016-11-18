<?php
namespace Braghetto\Hokoml;

/**
* HttpClientInterface
*/

interface HttpClientInterface
{
    public function request($method, $uri, array $extra_curl_ops = []);

    public function get($uri, array $params = []);

    public function post($uri, array $params = [], array $body = []);

    public function put($uri, array $params = [], array $body = []);

    public function delete($uri, array $params = [], array $body = []);
}
