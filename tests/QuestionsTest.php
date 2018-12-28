<?php

namespace Hokoml\Tests;

class QuestionsTest extends AbstractTest
{
    private $product_id_test = 'MLB849088913';
    private $productData = [
        'title' => 'Lâmpada edson amarela',
        'category_id' => 'MLB189202',
        'listing_type_id' => 'bronze',
        'currency_id' => 'BRL',
        'price' => 5900.57,
        'available_quantity' => 2,
        'condition' => 'new',
    ];

    public function testListSimpleProdut()
    {
        $hokoProduct = $this->hokoml->product();

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

    public function testAskAQuestion()
    {

        if ($this->isProductListed() && !$this->isQuestionAsked()) {
            $hokoQuestion = $this->hokoml->question();
            $questionText = 'Test asking question?';

            $response = $hokoQuestion->ask($this->product_id_test, $questionText);
            $this->assertArrayHasKey('http_code', $response);
            $this->assertArrayHasKey('body', $response);
            $this->assertEquals(201, $response['http_code']);
            $this->assertEquals($questionText, $response['body']['text']);
            $this->session['question'] = [
                'id' => $response['body']['id'],
            ];
        }
    }

    private function isProductListed()
    {
        return !empty($this->session['simple_product']) && !empty($this->session['simple_product']['id']);
    }

    private function isQuestionAsked()
    {
        return !empty($this->session['question']) && !empty($this->session['question']['id']);
    }
}
