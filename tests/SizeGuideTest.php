<?php

namespace Hokoml\Tests;

class SizeGuideTest extends AbstractTest
{
    private $data = [
        "name" => "Size guide hokoml",
        "sizes" => [
            [
                "name" => "L",
                "measurements" => [
                    ["id" => "CHEST_CIRCUMFERENCE", "value" => "25 - 30"],
                    ["id" => "TOTAL_LENGTH", "value" => "55 - 60"],
                ]
            ],[
                "name" => "M",
                "measurements" => [
                    ["id" => "CHEST_CIRCUMFERENCE", "value" => "20 - 25"],
                    ["id" => "TOTAL_LENGTH", "value" => "45 - 50"],
                ]
            ]
        ]
    ];

    public function testGetSizeGuidesAtributes()
    {
        $sizeguide = $this->hokoml->sizeGuide();
        $response = $sizeguide->getMeasurementAttributes();
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
    }

    public function testCreateSizeGuide()
    {
        $sizeguide = $this->hokoml->sizeGuide();
        $response = $sizeguide->create($this->data);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(201, $response['http_code']);
        return $response['body']['id'];
    }

    /**
     * @depends testCreateSizeGuide
     */
    public function testGetSizeGuides($gid)
    {
        $sizeguide = $this->hokoml->sizeGuide();
        $response = $sizeguide->get();
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertArrayHasKey('charts', $response['body']);
        $this->assertArrayHasKey('paging', $response['body']);
        $this->assertEquals(200, $response['http_code']);
        if (!empty($response['body']['charts'])) {
            $lastChart = end($response['body']['charts']);
            if ($gid === $lastChart['id']) {
                return $gid;
            }
        }
    }

    /**
     * @depends testCreateSizeGuide
     */
    public function testUpdateSizeGuide($gid)
    {
        $sizeguide = $this->hokoml->sizeGuide();
        $newName = 'Size guide hokoml UPDATED';
        $data = array_merge($this->data, [
            'name' => $newName
        ]);
        $response = $sizeguide->update($gid, $data);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertEquals($newName, $response['body']['name']);
    }

    /**
     * @depends testCreateSizeGuide
     */
    public function testFindSizeGuide($gid)
    {
        if (empty($gid)) {
            return;
        }
        $sizeguide = $this->hokoml->sizeGuide();
        $response = $sizeguide->find($gid);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertEquals($gid, $response['body']['id']);
    }

    /**
     * @depends testCreateSizeGuide
     */
    public function testGetAssociatedItems($gid)
    {
        if (empty($gid)) {
            return;
        }
        $sizeguide = $this->hokoml->sizeGuide();
        $response = $sizeguide->getAssociatedItems($gid);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertArrayHasKey('items', $response['body']);
        $this->assertArrayHasKey('paging', $response['body']);
        $this->assertEquals(200, $response['http_code']);
    }

    /**
     * @depends testCreateSizeGuide
     */
    public function testDeleteSizeGuide($gid)
    {
        if (empty($gid)) {
            return;
        }
        $sizeguide = $this->hokoml->sizeGuide();
        $response = $sizeguide->delete($gid);
        $this->assertArrayHasKey('http_code', $response);
        $this->assertArrayHasKey('body', $response);
        $this->assertEquals(200, $response['http_code']);
        $this->assertNull($response['body']);
    }
}
