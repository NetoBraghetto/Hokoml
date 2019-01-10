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

    public function testListProdut()
    {
        if ($this->isProductListed()) {
            return;
        }

        $hokoProduct = $this->hokoml->product();
        $response = $hokoProduct->validate($this->productData);
        $this->assertEquals(204, $response['http_code']);

        $response = $hokoProduct->create($this->productData);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(201, $response['http_code']);
        $this->assertEquals(count($this->productData['variations']), count($response['body']['variations']));
        $this->session['product_with_variations'] = [
            'id' => $response['body']['id'],
        ];
        $this->setSessionProductData($response['body']);
    }

    public function testUpdateProdutVariationsPrice()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoProduct = $this->hokoml->product();

        $newPrice = 7577.32;
        $response = $hokoProduct->updatePrice($this->session['product_with_variations']['id'], $newPrice);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertNotEmpty($response['body']['variations']);
        $this->assertEquals($newPrice, $response['body']['variations'][0]['price']);
        $this->setSessionProductData($response['body']);
    }

    public function testUpdateProdutVariationsStock()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoProduct = $this->hokoml->product();

        $newStocks = [];
        foreach ($this->session['product_with_variations']['variations'] as $variation) {
            $newStocks[] = [
                'id' => $variation['id'],
                'available_quantity' => 4,
            ];
        }
        $response = $hokoProduct->update($this->session['product_with_variations']['id'], [
            'variations' => $newStocks
        ]);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertNotEmpty($response['body']['variations']);
        $variation_ids = array_column($response['body']['variations'], 'id');
        foreach ($newStocks as $variationStock) {
            $index = array_search($variationStock['id'], $variation_ids);
            $this->assertNotFalse($index);
            $this->assertEquals($variationStock['id'], $response['body']['variations'][$index]['id']);
            $this->assertEquals($variationStock['available_quantity'], $response['body']['variations'][$index]['available_quantity']);
        }
    }

    public function testUpdateDescriptionOnlyByUpateMethod()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoProduct = $this->hokoml->product();

        $changes = [
            'description' => ['plain_text' => 'New Description 1']
        ];
        $response = $hokoProduct->update($this->session['product_with_variations']['id'], $changes);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertEquals($changes['description']['plain_text'], $response['body']['plain_text']);
    }

    public function testUpdateProductWithDescription()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoProduct = $this->hokoml->product();

        $changes = [
            'title' => 'Sandália Feminina Beira Rio Flatform Nude UPDATED',
            'description' => ['plain_text' => 'New Description 2']
        ];
        $response = $hokoProduct->update($this->session['product_with_variations']['id'], $changes);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertEquals(mb_strtolower($changes['title']), mb_strtolower($response['body']['title']));
        $this->assertEquals($changes['description']['plain_text'], $response['body']['descriptions']['plain_text']);
    }

    public function testUpdateDescriptionOnlyByUpateDescriptionMethod()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoProduct = $this->hokoml->product();

        $newDescription = ['plain_text' => 'New Description 3'];
        $response = $hokoProduct->updateDescription($this->session['product_with_variations']['id'], $newDescription);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertEquals($newDescription['plain_text'], $response['body']['plain_text']);
    }

    public function testUpdateAddNewVariation()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoProduct = $this->hokoml->product();

        $changes = [
            'pictures' => $this->session['product_with_variations']['pictures'],
            'variations' => [],
        ];
        foreach ($this->session['product_with_variations']['variations'] as $variation) {
            $changes['variations'][] = [
                'id' => $variation['id']
            ];
        }
        // Add new variations after ids matters
        $changes['pictures'][] = ['source' => 'http://placehold.it/1200x1200/fb8d00/000000?text=Var4A'];
        $changes['pictures'][] = ['source' => 'http://placehold.it/1200x1200/fb8d00/000000?text=Var4B'];
        $changes['variations'][] = [
            'price' => $this->session['product_with_variations']['variations'][0]['price'],
            'available_quantity' => 8,
            'attribute_combinations' => [
                ['id' => 'COLOR', 'value_id' => null, 'value_name' => 'Laranja'],
                ['id' => 'SIZE', 'value_id' => null, 'value_name' => '40'],
            ],
            'attributes' => [
                ['id' => 'MAIN_COLOR', 'value_id' => '2450327', 'value_name' => 'Laranja'],
                ['id' => 'GTIN', 'value_id' => '7892758644922', 'value_name' => '7892758644922'],
            ],
            'picture_ids' => [
                'http://placehold.it/1200x1200/fb8d00/000000?text=Var4A',
                'http://placehold.it/1200x1200/fb8d00/000000?text=Var4B',
            ],
        ];
        $response = $hokoProduct->update($this->session['product_with_variations']['id'], $changes);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertEquals(count($changes['variations']), count($response['body']['variations']));
        $this->setSessionProductData($response['body']);
    }

    public function testUpdateRemoveVariation()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoProduct = $this->hokoml->product();

        $changes = [
            'pictures' => $this->session['product_with_variations']['pictures'],
            'variations' => [],
        ];
        foreach ($this->session['product_with_variations']['variations'] as $variation) {
            $changes['variations'][] = [
                'id' => $variation['id']
            ];
        }
        $changes['pictures'] = array_slice($changes['pictures'], 0, -2);
        $changes['variations'] = array_slice($changes['variations'], 0, -1);
        $response = $hokoProduct->update($this->session['product_with_variations']['id'], $changes);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertEquals(count($changes['variations']), count($response['body']['variations']));
        $this->setSessionProductData($response['body']);
    }

    private function isProductListed()
    {
        return !empty($this->session['product_with_variations']) && !empty($this->session['product_with_variations']['id']);
    }

    private function setSessionProductData($data)
    {
        $this->session['product_with_variations']['variations'] = [];
        foreach ($data['variations'] as $variation) {
            $this->session['product_with_variations']['variations'][] = [
                'id' => $variation['id'],
                'price' => $variation['price'],
                'available_quantity' => $variation['available_quantity'],
            ];
        }

        $this->session['product_with_variations']['pictures'] = [];
        foreach ($data['pictures'] as $picture) {
            $this->session['product_with_variations']['pictures'][] = [
                'id' => $picture['id'],
            ];
        }
    }
}
