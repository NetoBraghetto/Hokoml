<?php
namespace Braghetto\Hokoml;

/**
* AppInterface
*/

interface AppInterface
{
    public function getAuthUrl($redirect_uri = null);

    public function authorize($code);

    public function refreshAccessToken($refresh_token);

    public function getCountry();

    public function getApiUrl();
    
    public function getAccessToken();
}
