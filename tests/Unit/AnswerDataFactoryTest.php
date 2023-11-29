<?php

declare(strict_types=1);

use App\Data\Response\Factories\AnswerDataFactory;
use PHPUnit\Framework\TestCase;
use App\Data\Response\AnswerData;
use Symfony\Component\HttpFoundation\Response;

class AnswerDataFactoryTest extends TestCase
{
    public function testAnswerDataFactoryTest(): void
    {
        $testAnswerData = new AnswerData(
            status: Response::HTTP_OK, message: 'test', data: true, code: 'error_code'
        );

        $answerData = AnswerDataFactory::getDTO(
            collect([Response::HTTP_OK, 'test', true, 'error_code',])
        );

        $this->assertObjectEquals($answerData, $testAnswerData);
    }
}
