<?php

namespace Data;

use App\Data\Response\ResponseData;
use PHPUnit\Framework\TestCase;

class ResponseDataTest extends TestCase
{
    /**
     * @return ResponseData
     */
    public function testGetResponseDataClass(): ResponseData
    {
        $responseData = new ResponseData(status: 200, message: 'OK', data: true);

        $this->assertTrue(is_a($responseData, 'App\Data\Response\ResponseData'));

        return $responseData;
    }

    /**
     * @return void
     * @depends testGetResponseDataClass
     */
    public function test__construct()
    {
        $responseData = $this->testGetResponseDataClass();

        $this->assertObjectHasProperty('status', $responseData);
        $this->assertObjectHasProperty('message', $responseData);
        $this->assertObjectHasProperty('data', $responseData);
    }

    /**
     * @return void
     * @depends testGetResponseDataClass
     */
    public function testGetData()
    {
        $this->assertEquals(
            expected: collect([
                'status' => 200,
                'message' => 'OK',
                'data' => true,
            ]),
            actual: $this->testGetResponseDataClass()->getData(),
        );
    }
}
