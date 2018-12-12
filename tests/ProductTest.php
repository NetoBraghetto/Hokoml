<?php

namespace Hokoml\Tests;

class ProductTest extends AbstractTest
{
    private $simpleProductData = [
        'title' => 'Lâmpada edson amarela',
        'category_id' => 'MLB189202',
        'listing_type_id' => 'bronze',
        'currency_id' => 'BRL',
        'price' => 8529.37,
        'available_quantity' => 2,
        'condition' => 'new',
    ];

    public function testValidateProdutData()
    {
        $hokoProduct = $this->hokoml->product();
        $response = $hokoProduct->validate([]);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(400, $response['http_code']);
    }

    public function testListSimpleProdut()
    {
        $hokoProduct = $this->hokoml->product();
        $response = $hokoProduct->validate($this->simpleProductData);
        $this->assertEquals(204, $response['http_code']);

        $response = $hokoProduct->create($this->simpleProductData);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(201, $response['http_code']);
    }
}
