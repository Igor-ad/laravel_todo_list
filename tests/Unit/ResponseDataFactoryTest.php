<?php

declare(strict_types=1);

use App\Data\Response\ResponseData;
use App\Data\Response\Factories\ResponseDataFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ResponseDataFactoryTest extends TestCase
{
    public function testResponseDataFactoryTest()
    {
        $testResponseData = new ResponseData(
            status: Response::HTTP_CREATED, message: 'test', data: 1
        );

        $responseData = ResponseDataFactory::getDTO(
            collect([Response::HTTP_CREATED, 'test', 1,])
        );

        $this->assertObjectEquals($testResponseData, $responseData);
    }
}
