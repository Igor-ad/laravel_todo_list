<?php

namespace Data;

use App\Data\ResponseData;
use PHPUnit\Framework\TestCase;

class ResponseDataTest extends TestCase
{
    /**
     * @return ResponseData
     */
    public function getResponseDataClass(): ResponseData
    {
        return new ResponseData(200, 'OK', true);
    }

    /**
     * @return void
     */
    public function test__construct()
    {
        $responseData = new ResponseData(200, 'OK', true);

        $this->assertTrue(is_a($responseData,  'App\Data\ResponseData'));
        $this->assertObjectHasProperty('status', $responseData);
        $this->assertObjectHasProperty('message', $responseData);
        $this->assertObjectHasProperty('data', $responseData);
    }

    public function testGetData()
    {
        $this->assertEquals(
            expected: collect([
                'status' => 200,
                'message' => 'OK',
                'data' => true,
            ]),
            actual: $this->getResponseDataClass()->getData(),
        );
    }
}
