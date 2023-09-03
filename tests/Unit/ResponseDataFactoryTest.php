<?php


use App\Data\ResponseData;
use Database\Factories\ResponseDataFactory;
use PHPUnit\Framework\TestCase;

class ResponseDataFactoryTest extends TestCase
{

    public function testResponseDataFactoryTest()
    {
        $testResponseData = new ResponseData(
            status: 201, message: 'test', data: true
        );

        $responseData = ResponseDataFactory::responseData(
            status: 201,
            message: 'test',
            data: true,
        );

        $this->assertObjectEquals($testResponseData, $responseData);
    }
}
