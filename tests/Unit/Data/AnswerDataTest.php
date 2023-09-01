<?php

namespace Data;

use App\Data\AnswerData;
use PHPUnit\Framework\TestCase;

class AnswerDataTest extends TestCase
{
    /**
     * @return AnswerData
     */
    public function getAnswerDataClass(): AnswerData
    {
        return new AnswerData(200, 'test', new \stdClass(), 'code=987');
    }

    /**
     * @return void
     */
    public function test__construct()
    {
        $answerData = new AnswerData(200, 'test', true, 'code=987');

        $this->assertTrue(is_a($answerData,  'App\Data\AnswerData'));
        $this->assertObjectHasProperty('status', $answerData);
        $this->assertObjectHasProperty('message', $answerData);
        $this->assertObjectHasProperty('data', $answerData);
        $this->assertObjectHasProperty('code', $answerData);

        $this->assertEquals(
            expected: collect([
                'status' => 200,
                'message' => 'test',
                'data' => true,
                'code' => 'code=987'
            ]),
            actual: $answerData->getData(),
        );
    }

    /**
     * @return void
     */
    public function testGetData()
    {
        $this->assertEquals(
            expected: collect([
                'status' => 200,
                'message' => 'test',
                'data' => new \stdClass(),
                'code' => 'code=987'
            ]),
            actual: $this->getAnswerDataClass()->getData(),
        );
    }

    /**
     * @return void
     */
    public function testGetStatus()
    {
        $this->assertEquals(
            expected: 200,
            actual: $this->getAnswerDataClass()->getStatus(),
        );
    }
}
