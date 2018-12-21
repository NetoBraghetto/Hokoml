<?php

namespace Hokoml\Tests;

class ProductWithVariationTest extends AbstractTest
{
    private $productData = [
        'title' => 'Sandália Feminina Beira Rio Flatform Nude',
        'category_id' => 'MLB250925',
        'listing_type_id' => 'bronze',
        'currency_id' => 'BRL',
        'price' => 7000.00,
        // 'available_quantity' => 2,
        'condition' => 'new',
        'description' => [
            'plain_text' => "Bota Masculina Freeway Absolut Texas Capuccino \n\nO extremo conforto e durabilidade de um modelo feito para você viver intensamente. A Bota Freeway Absolut 1 foi desenvolvida para lhe trazer muito estilo, conforto e segurança. Indicada para qualquer estação do ano e combina com diferentes looks, sempre mesclado a um design arrojado, com segurança e consistência. Bota Freeway Absolut 1, confeccionada em couro. Traz amarra em cadarços, além de zíper que abrem as duas laterais e facilita o calce. Apresenta recortes e pespontos pelo modelo, e puxador no calcanhar. Com design moderno oferece parte superior do cano em tecido confortável. Conta com forro em material têxtil e palmilha em PU. Já o solado é em borracha tratorada. Acompanha par extra de cadarços!"
        ],
        'pictures' => [
            ['source' => 'http://placehold.it/1200x1200/00ddff/000000?text=Var1A'],
            ['source' => 'http://placehold.it/1200x1200/00ddff/000000?text=Var1B'],
            ['source' => 'http://placehold.it/1200x1200/b50000/ffffff?text=Var2A'],
            ['source' => 'http://placehold.it/1200x1200/b50000/ffffff?text=Var2B'],
            ['source' => 'http://placehold.it/1200x1200/b50000/ffffff?text=Var2C'],
            ['source' => 'http://placehold.it/1200x1200/40820f/ffffff?text=Var3A'],
            ['source' => 'http://placehold.it/1200x1200/40820f/ffffff?text=Var3B'],
        ],
        'variations' => [
            // Blue 37 - 38
            [
                'price' => 7000.00,
                'available_quantity' => 1,
                'attribute_combinations' => [
                    ['id' => 'COLOR', 'value_id' => null, 'value_name' => 'Azul claro'],
                    ['id' => 'SIZE', 'value_id' => null, 'value_name' => '37'],
                ],
                'attributes' => [
                    ['id' => 'MAIN_COLOR', 'value_id' => '2450298', 'value_name' => 'Azul claro'],
                    ['id' => 'GTIN', 'value_id' => '7892758644918', 'value_name' => '7892758644918'],
                ],
                'picture_ids' => [
                    'http://placehold.it/1200x1200/00ddff/000000?text=Var1A',
                    'http://placehold.it/1200x1200/00ddff/000000?text=Var1B',
                ],
            ],
            [
                'price' => 7000.00,
                'available_quantity' => 2,
                'attribute_combinations' => [
                    ['id' => 'COLOR', 'value_id' => null, 'value_name' => 'Azul claro'],
                    ['id' => 'SIZE', 'value_id' => null, 'value_name' => '38'],
                ],
                'attributes' => [
                    ['id' => 'MAIN_COLOR', 'value_id' => '2450298', 'value_name' => 'Azul claro'],
                    ['id' => 'GTIN', 'value_id' => '7892758644918', 'value_name' => '7892758644918'],
                ],
                'picture_ids' => [
                    'http://placehold.it/1200x1200/00ddff/000000?text=Var1A',
                    'http://placehold.it/1200x1200/00ddff/000000?text=Var1B',
                ],
            ],
            // Red 38 - 40
            [
                'price' => 7000.00,
                'available_quantity' => 1,
                'attribute_combinations' => [
                    ['id' => 'COLOR', 'value_id' => null, 'value_name' => 'Vermelho'],
                    ['id' => 'SIZE', 'value_id' => null, 'value_name' => '38'],
                ],
                'attributes' => [
                    ['id' => 'MAIN_COLOR', 'value_id' => '2450307', 'value_name' => 'Vermelho'],
                    ['id' => 'GTIN', 'value_id' => '7892758644919', 'value_name' => '7892758644919'],
                ],
                'picture_ids' => [
                    'http://placehold.it/1200x1200/b50000/ffffff?text=Var2A',
                    'http://placehold.it/1200x1200/b50000/ffffff?text=Var2B',
                    'http://placehold.it/1200x1200/b50000/ffffff?text=Var2C',
                ],
            ],
            [
                'price' => 7000.00,
                'available_quantity' => 3,
                'attribute_combinations' => [
                    ['id' => 'COLOR', 'value_id' => null, 'value_name' => 'Vermelho-Preto'],
                    ['id' => 'SIZE', 'value_id' => null, 'value_name' => '38'],
                ],
                'attributes' => [
                    ['id' => 'MAIN_COLOR', 'value_id' => '2450307', 'value_name' => 'Vermelho'],
                    ['id' => 'GTIN', 'value_id' => '7892758644919', 'value_name' => '7892758644919'],
                ],
                'picture_ids' => [
                    'http://placehold.it/1200x1200/b50000/ffffff?text=Var2A',
                    'http://placehold.it/1200x1200/b50000/ffffff?text=Var2B',
                    'http://placehold.it/1200x1200/b50000/ffffff?text=Var2C',
                ],
            ],
            // Verde 42
            [
                'price' => 7000.00,
                'available_quantity' => 1,
                'attribute_combinations' => [
                    ['id' => 'COLOR', 'value_id' => null, 'value_name' => 'Verde musgo-Branco'],
                    ['id' => 'SIZE', 'value_id' => null, 'value_name' => '42'],
                ],
                'attributes' => [
                    ['id' => 'MAIN_COLOR', 'value_id' => '2450310', 'value_name' => 'Branco'],
                    ['id' => 'GTIN', 'value_id' => '7892758644920', 'value_name' => '7892758644920'],
                ],
                'picture_ids' => [
                    'http://placehold.it/1200x1200/40820f/ffffff?text=Var3A',
                    'http://placehold.it/1200x1200/40820f/ffffff?text=Var3B',
                ],
            ],
        ],
    ];

    // public function testValidateProdutData()
    // {
    //     $hokoProduct = $this->hokoml->product();
    //     $response = $hokoProduct->validate($this->productData);
    //     $this->dump($response);
    // }

    public function testListProdut()
    {
        $hokoProduct = $this->hokoml->product();
        $response = $hokoProduct->validate($this->productData);
        if ($response['http_code'] !== 204) {
            $this->dump($response);
        }
        $this->assertEquals(204, $response['http_code']); // supress the Risk warn

        if (empty($this->session['product_with_variations_id'])) {
            $response = $hokoProduct->create($this->productData);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(201, $response['http_code']);
            $this->session['product_with_variations_id'] = $response['body']['id'];
        }
    }

    public function testUpdateProdutVariationsPrice()
    {
        $hokoProduct = $this->hokoml->product();

        if (!empty($this->session['product_with_variations_id'])) {
            $newPrice = 7577.32;
            $response = $hokoProduct->updatePrice($this->session['product_with_variations_id'], $newPrice);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(200, $response['http_code']);
            $this->assertNotEmpty($response['body']['variations']);
            $this->assertEquals($newPrice, $response['body']['variations'][0]['price']);
        }
    }

    // public function testUpdateProdut()
    // {
    //     $hokoProduct = $this->hokoml->product();

    //     if (!empty($this->session['product_with_variations_id'])) {
    //         $changes = [
    //             // 'title' => 'Lâmpada edson amarela RT',
    //             'price' => 7500.00,
    //         ];
    //         $response = $hokoProduct->update($this->session['product_with_variations_id'], $changes);
    //         $this->dump($response);
    //         $this->assertArrayHasKey('http_code', $response);
    //         $this->assertArrayHasKey('body', $response);
    //         $this->assertEquals(200, $response['http_code']);
    //         $this->assertEquals($this->session['product_with_variations_id'], $response['body']['id']);
    //         // $this->assertEquals(mb_strtolower($changes['title']), mb_strtolower($response['body']['title']));
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
