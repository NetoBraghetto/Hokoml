<?php

namespace Hokoml\Tests;

class SimpleProductTest extends AbstractTest
{
    private $productData = [
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
        $response = $hokoProduct->validate($this->productData);
        if ($response['http_code'] !== 204) {
            $this->dump($response);
        }
        $this->assertEquals(204, $response['http_code']); // supress the Risk warn

        if (!$this->isProductListed()) {
            $response = $hokoProduct->create($this->productData);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(201, $response['http_code']);
            $this->session['simple_product'] = [
                'id' => $response['body']['id'],
            ];
        }
    }

    public function testUpdateSimpleProdut()
    {
        $hokoProduct = $this->hokoml->product();

        if ($this->isProductListed()) {
            $changes = [
                'title' => 'Lâmpada edson amarela RT',
                'price' => 4995.88,
            ];
            $response = $hokoProduct->update($this->session['simple_product']['id'], $changes);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(200, $response['http_code']);
            $this->assertEquals($this->session['simple_product']['id'], $response['body']['id']);
            $this->assertEquals(mb_strtolower($changes['title']), mb_strtolower($response['body']['title']));
            $this->assertEquals($changes['price'], $response['body']['price']);
        }
    }

    public function testPauseProdut()
    {
        $hokoProduct = $this->hokoml->product();
        
        if ($this->isProductListed()) {
            $response = $hokoProduct->pause($this->session['simple_product']['id']);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(200, $response['http_code']);
        }
    }

    public function testUnpauseProdut()
    {
        $hokoProduct = $this->hokoml->product();
        
        if ($this->isProductListed()) {
            $response = $hokoProduct->unpause($this->session['simple_product']['id']);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(200, $response['http_code']);
        }
    }

    public function testFinalizeProdut()
    {
        $hokoProduct = $this->hokoml->product();
        
        if ($this->isProductListed()) {
            $response = $hokoProduct->finalize($this->session['simple_product']['id']);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(200, $response['http_code']);
        }
    }

    public function testRelistProdut()
    {
        $hokoProduct = $this->hokoml->product();
        
        if ($this->isProductListed()) {
            $newPrice = 7588.67;
            $newQuantity = 7;
            $response = $hokoProduct->relist(
                $this->session['simple_product']['id'],
                $newPrice,
                $newQuantity,
                'bronze'
            );
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(201, $response['http_code']);
            $this->assertEquals($newPrice, $response['body']['price']);
            $this->assertEquals($newQuantity, $response['body']['available_quantity']);
            $this->assertNotEquals($this->session['simple_product']['id'], $response['body']['id']);
            $this->session['simple_product']['id'] = $response['body']['id'];
        }
    }

    public function testDeleteProdut()
    {
        $hokoProduct = $this->hokoml->product();
        
        if ($this->isProductListed()) {
            $response = $hokoProduct->finalize($this->session['simple_product']['id']);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(200, $response['http_code']);

            $response = $hokoProduct->delete($this->session['simple_product']['id']);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(200, $response['http_code']);

            unset($this->session['simple_product']);
        }
    }

    private function isProductListed()
    {
        return !empty($this->session['simple_product']) && !empty($this->session['simple_product']['id']);
    }
}
