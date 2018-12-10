<?php
namespace Hokoml\Tests;

use Braghetto\Hokoml\Hokoml;

class AppTest extends AbstractTest
{
    public function testGetAuthUrl()
    {
        $app = $this->hokoml->app();
        $parsedAuthURL = parse_url($app->getAuthUrl());
        $this->assertEquals('auth.mercadolivre.com.br', $parsedAuthURL['host']);
        $this->assertEquals('/authorization', $parsedAuthURL['path']);
        // var_dump(parse_url($authURL));exit;
    }
}
