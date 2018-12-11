<?php
namespace Hokoml\Tests;

use PHPUnit\Framework\TestCase;
use Braghetto\Hokoml\Hokoml;

abstract class AbstractTest extends TestCase
{
    protected $hokoml;

    protected $session;

    protected $sessionPath = __DIR__ . '/web/fake_session';

    public function __construct() {
        parent::__construct();
        $config = require __DIR__ . '/web/config.php';
        $this->hokoml = new Hokoml($config);
        if (!file_exists($this->sessionPath)) {
            file_put_contents($this->sessionPath, '[]');
        }
    }

    public function setUp()
    {
        $this->session = json_decode(file_get_contents($this->sessionPath), true);
        if ($this->session['mercado_livre']['expires_in'] <= time()) {
            $this->refreshAccessToken();
        }
    }

    public function tearDown()
    {
        file_put_contents($this->sessionPath, json_encode($this->session));
    }

    protected function refreshAccessToken()
    {
        $app = $this->hokoml->app();
        $response = $app->refreshAccessToken($this->session['mercado_livre']['refresh_token']);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        if ($response['http_code'] === 200) {
            $this->session['mercado_livre'] = [
                'access_token' => $response['body']['access_token'],
                'refresh_token' => $response['body']['refresh_token'],
                'expires_in' => time() + $response['body']['expires_in'] + 1,
                'user_id' => $response['body']['user_id'],
            ];
        }
    }
}
