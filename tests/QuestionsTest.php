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
        if ($this->isProductListed()) {
            return;
        }

        $hokoProduct = $this->hokoml->product();
        $response = $hokoProduct->create($this->productData);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(201, $response['http_code']);
        $this->session['simple_product'] = [
            'id' => $response['body']['id'],
        ];
    }

    public function testAskAQuestion()
    {
        if ($this->isQuestionAsked()) {
            return;
        }

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

    public function testListReceivedQuestions()
    {
        $hokoQuestion = $this->hokoml->question();

        $response = $hokoQuestion->received();
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        if ($response['body']['total'] > 0 && !$this->hasQuestionToAnswer()) {
            $hokoProduct = $this->hokoml->product();
            $responseProd = $hokoProduct->find($response['body']['questions'][0]['item_id']);
            if ($responseProd['body']['status'] === 'active') {
                $this->session['received_question'] = [
                    'id' => $response['body']['questions'][0]['id']
                ];
            }
        }
    }

    public function testAnswerQuestion()
    {
        if (!$this->hasQuestionToAnswer()) {
            return;
        }
        $hokoQuestion = $this->hokoml->question();
        $answerText = 'Test answering a question.';

        $response = $hokoQuestion->answer($this->session['received_question']['id'], $answerText);
        $this->dump($response);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(201, $response['http_code']);
        $this->assertEquals($answerText, $response['body']['text']);
        $this->session['question'] = [
            'id' => $response['body']['id'],
        ];
    }

    public function testListReceivedQuestionsFromProduct()
    {
        if (!$this->isProductListed()) {
            return;
        }
        $hokoQuestion = $this->hokoml->question();

        $response = $hokoQuestion->fromProduct($this->session['simple_product']['id']);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
    }

    private function isProductListed()
    {
        return !empty($this->session['simple_product']) && !empty($this->session['simple_product']['id']);
    }

    private function isQuestionAsked()
    {
        return !empty($this->session['question']) && !empty($this->session['question']['id']);
    }

    private function hasQuestionToAnswer()
    {
        return !empty($this->session['received_question']) && !empty($this->session['received_question']['id']);
    }
}
