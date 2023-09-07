<?php

use App\Data\Response\ResponseData;
use App\Data\Response\Factories\ResponseDataFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ResponseDataFactoryTest extends TestCase
{

    /**
     * @return void
     */
    public function testResponseDataFactoryTest()
    {
        $testResponseData = new ResponseData(
            status: Response::HTTP_CREATED, message: 'test', data: true
        );

        $responseData = ResponseDataFactory::getDTO(
            collect([Response::HTTP_CREATED, 'test', true,])
        );

        $this->assertObjectEquals($testResponseData, $responseData);
    }
}
