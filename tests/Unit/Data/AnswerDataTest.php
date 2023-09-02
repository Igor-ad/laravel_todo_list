<?php

namespace Data;

use App\Data\AnswerData;
use PHPUnit\Framework\TestCase;

class AnswerDataTest extends TestCase
{
    /**
     * @return AnswerData
     */
    public function testGetAnswerDataClass(): AnswerData
    {
        $answerData =  new AnswerData(200, 'test', true, 'code=987');

        $this->assertTrue(is_a($answerData, 'App\Data\AnswerData'));

        return $answerData;
    }

    /**
     * @return void
     * @depends testGetAnswerDataClass
     */
    public function test__construct()
    {
        $answerData = $this->testGetAnswerDataClass();

        $this->assertObjectHasProperty('status', $answerData);
        $this->assertObjectHasProperty('message', $answerData);
        $this->assertObjectHasProperty('data', $answerData);
        $this->assertObjectHasProperty('code', $answerData);
    }

    /**
     * @return void
     * @depends testGetAnswerDataClass
     */
    public function testGetData()
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

    /**
     * @return void
     * @depends testGetAnswerDataClass
     */
    public function testGetStatus()
    {
        $this->assertEquals(
            expected: 200,
            actual: $this->testGetAnswerDataClass()->getStatus(),
        );
    }
}
