<?php


use App\Data\ResponseData;
use Database\Factories\ResponseDataFactory;
use PHPUnit\Framework\TestCase;

class ResponseDataFactoryTest extends TestCase
{

    public function testResponseDataFactoryTest()
    {
        $testResponseData = new ResponseData(201, 'test', true);

        $responseData = ResponseDataFactory::responseData(
            201,
            'test',
            true,
        );

        $this->assertObjectEquals($testResponseData, $responseData);
    }
}
