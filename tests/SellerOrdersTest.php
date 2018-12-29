<?php

namespace Hokoml\Tests;

class SellerOrdersTest extends AbstractTest
{
    public function testGetOrder()
    {
        $hokoOrder = $this->hokoml->order();
        $response = $hokoOrder->get();
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
    }
}
