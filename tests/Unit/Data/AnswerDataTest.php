<?php

declare(strict_types=1);

namespace Data;

use App\Data\Response\AnswerData;
use PHPUnit\Framework\TestCase;

class AnswerDataTest extends TestCase
{
    public function testGetAnswerDataClass(): AnswerData
    {
        $answerData = new AnswerData(
            status: 200, message: 'test', data: true, code: 'code=987'
        );

        $this->assertTrue(is_a($answerData, 'App\Data\Response\AnswerData'));

        return $answerData;
    }

    public function test__construct(): void
    {
        $answerData = $this->testGetAnswerDataClass();

        $this->assertObjectHasProperty('status', $answerData);
        $this->assertObjectHasProperty('message', $answerData);
        $this->assertObjectHasProperty('data', $answerData);
        $this->assertObjectHasProperty('code', $answerData);
    }

    public function testGetData(): void
    {
        $this->assertEquals(
            expected: collect([
                'status' => 200,
                'message' => 'test',
                'data' => true,
                'code' => 'code=987'
            ]),
            actual: $this->testGetAnswerDataClass()->getData(),
        );
    }

    public function testGetStatus(): void
    {
        $this->assertEquals(
            expected: 200,
            actual: $this->testGetAnswerDataClass()->getStatus(),
        );
    }
}
