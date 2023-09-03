<?php

use Database\Factories\AnswerDataFactory;
use PHPUnit\Framework\TestCase;
use App\Data\AnswerData;

class AnswerDataFactoryTest extends TestCase
{

    /**
     * @return void
     */
    public function testAnswerDataFactoryTest()
    {
        $testAnswerData = new AnswerData(
            status: 200, message: 'test', data: true, code: 'error_code'
        );

        $answerData = AnswerDataFactory::answerData(collect([
            200,
            'test',
            true,
            'error_code',
        ]));

        $this->assertObjectEquals($answerData, $testAnswerData);
    }
}
