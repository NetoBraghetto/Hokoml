<?php

namespace Hokoml\Tests;

class ProductTest extends AbstractTest
{
    private $productData = [
        'title' => 'Sandália Feminina Beira Rio Flatform Nude',
        'category_id' => 'MLB250925',
        'listing_type_id' => 'bronze',
        'currency_id' => 'BRL',
        'price' => 6529.37,
        'available_quantity' => 2,
        'condition' => 'new',
        'pictures' => [
            ['source' => 'http://placehold.it/1200x1200/00ddff/000000?text=Var1A'],
            ['source' => 'http://placehold.it/1200x1200/00ddff/000000?text=Var1B'],
            ['source' => 'http://placehold.it/1200x1200/b50000/ffffff?text=Var2A'],
            ['source' => 'http://placehold.it/1200x1200/b50000/ffffff?text=Var2B'],
            ['source' => 'http://placehold.it/1200x1200/b50000/ffffff?text=Var2C'],
            ['source' => 'http://placehold.it/1200x1200/40820f/ffffff?text=Var3A'],
            ['source' => 'http://placehold.it/1200x1200/40820f/ffffff?text=Var3B'],
        ],
    ];

    // public function testValidateProdutData()
    // {
    //     $hokoProduct = $this->hokoml->product();
    //     $response = $hokoProduct->validate([]);
    //     $this->assertArrayHasKey('http_code', $response);
    //     $this->assertArrayHasKey('body', $response);
    //     $this->assertEquals(400, $response['http_code']);
    // }

    // public function testListSimpleProdut()
    // {
    //     $hokoProduct = $this->hokoml->product();
    //     $response = $hokoProduct->validate($this->productData);
    //     if ($response['http_code'] !== 204) {
    //         $this->dump($response);
    //     }
    //     $this->assertEquals(204, $response['http_code']); // supress the Risk warn

    //     if (empty($this->session['product_with_variations_id'])) {
    //         $response = $hokoProduct->create($this->productData);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(201, $response['http_code']);
    //         $this->session['product_with_variations_id'] = $response['body']['id'];
    //     }
    // }

    // public function testUpdateSimpleProdut()
    // {
    //     $hokoProduct = $this->hokoml->product();

    //     if (!empty($this->session['simple_product_id'])) {
    //         $changes = [
    //             'title' => 'Lâmpada edson amarela RT',
    //             'price' => 4995.88,
    //         ];
    //         $response = $hokoProduct->update($this->session['simple_product_id'], $changes);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(200, $response['http_code']);
    //         $this->assertEquals($this->session['simple_product_id'], $response['body']['id']);
    //         $this->assertEquals(mb_strtolower($changes['title']), mb_strtolower($response['body']['title']));
    //         $this->assertEquals($changes['price'], $response['body']['price']);
    //     }
    // }

    // public function testPauseProdut()
    // {
    //     $hokoProduct = $this->hokoml->product();
        
    //     if (!empty($this->session['product_with_variations_id'])) {
    //         $response = $hokoProduct->pause($this->session['product_with_variations_id']);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(200, $response['http_code']);
    //     }
    // }

    // public function testUnpauseProdut()
    // {
    //     $hokoProduct = $this->hokoml->product();
        
    //     if (!empty($this->session['product_with_variations_id'])) {
    //         $response = $hokoProduct->unpause($this->session['product_with_variations_id']);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(200, $response['http_code']);
    //     }
    // }

    // public function testFinalizeProdut()
    // {
    //     $hokoProduct = $this->hokoml->product();
        
    //     if (!empty($this->session['product_with_variations_id'])) {
    //         $response = $hokoProduct->finalize($this->session['product_with_variations_id']);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(200, $response['http_code']);
    //     }
    // }

    // public function testRelistProdut()
    // {
    //     $hokoProduct = $this->hokoml->product();
        
    //     if (!empty($this->session['product_with_variations_id'])) {
    //         $newPrice = 7588.67;
    //         $newQuantity = 7;
    //         $response = $hokoProduct->relist(
    //             $this->session['product_with_variations_id'],
    //             $newPrice,
    //             $newQuantity,
    //             'bronze'
    //         );
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(201, $response['http_code']);
    //         $this->assertEquals($newPrice, $response['body']['price']);
    //         $this->assertEquals($newQuantity, $response['body']['available_quantity']);
    //         $this->assertNotEquals($this->session['product_with_variations_id'], $response['body']['id']);
    //         $this->session['product_with_variations_id'] = $response['body']['id'];
    //     }
    // }

    // public function testDeleteProduts()
    // {
    //     $hokoProduct = $this->hokoml->product();
        
    //     if (!empty($this->session['product_with_variations_id'])) {
    //         $response = $hokoProduct->finalize($this->session['product_with_variations_id']);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(200, $response['http_code']);

    //         $response = $hokoProduct->delete($this->session['product_with_variations_id']);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(200, $response['http_code']);

    //         unset($this->session['product_with_variations_id']);
    //     }
    // }
}
