<?php
namespace Hokoml\Tests;

class AppTest extends AbstractTest
{
    public function testGetAuthUrl()
    {
        $app = $this->hokoml->app();
        $authURL = $app->getAuthUrl();
        $parsedAuthURL = parse_url($authURL);
        $this->assertEquals('auth.mercadolivre.com.br', $parsedAuthURL['host']);
        $this->assertEquals('/authorization', $parsedAuthURL['path']);
        if (empty($this->session['mercado_livre'])) {    
            echo PHP_EOL . '/* ======== Visit de URL to authorize the app and restart the tests ========= */';
            echo PHP_EOL . $authURL;
            echo PHP_EOL . '/* ========================================================================== */';
            exit;
        }
    }

    public function testGetListingTypes()
    {
        $app = $this->hokoml->app();
        $response = $app->getListingTypes();
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertIsArray($response['body']);
    }

    public function testGetCategoryList()
    {
        $app = $this->hokoml->app();
        $response = $app->getCategories();
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertIsArray($response['body']);
        
        // Subcategories
        $response = $app->getCategories($response['body'][0]['id']);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertIsArray($response['body']);
    }

    public function testPredictCategory()
    {
        $app = $this->hokoml->app();
        $response = $app->predictCategory('Rayban masculino');
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertIsArray($response['body']);
        $this->assertArrayHasKey('prediction_probability', $response['body']);
    }

    public function testGetAttributesFromCategory()
    {
        $app = $this->hokoml->app();
        $response = $app->categoryAttributes('MLB5115');
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertIsArray($response['body']);
    }
}
