<?php

declare(strict_types=1);

namespace Data;

use App\Data\Response\ResponseData;
use PHPUnit\Framework\TestCase;

class ResponseDataTest extends TestCase
{
    public function testGetResponseDataClass(): ResponseData
    {
        $responseData = new ResponseData(status: 200, message: 'OK', data: true);

        $this->assertTrue(is_a($responseData, 'App\Data\Response\ResponseData'));

        return $responseData;
    }

    public function test__construct(): void
    {
        $responseData = $this->testGetResponseDataClass();

        $this->assertObjectHasProperty('status', $responseData);
        $this->assertObjectHasProperty('message', $responseData);
        $this->assertObjectHasProperty('data', $responseData);
    }

    public function testGetData(): void
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
