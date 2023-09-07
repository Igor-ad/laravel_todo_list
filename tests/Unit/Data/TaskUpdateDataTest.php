<?php

namespace Data;

use App\Data\Request\TaskUpdateData;
use PHPUnit\Framework\TestCase;

class TaskUpdateDataTest extends TestCase
{
    /**
     * @return TaskUpdateData
     */
    public function testGetUpdateDataClass(): TaskUpdateData
    {
        $updateData = new TaskUpdateData(
            id: 10,
            parent_id: 2,
            status: 'todo',
            priority: 5,
            title: 'test',
            description: 'New Test'
        );

        $this->assertTrue(is_a($updateData, 'App\Data\Request\TaskUpdateData'));

        return $updateData;
    }

    /**
     * @return void
     * @depends testGetUpdateDataClass
     */
    public function test__construct()
    {
        $updateData = $this->testGetUpdateDataClass();

        $this->assertObjectHasProperty('id', $updateData);
        $this->assertObjectHasProperty('parent_id', $updateData);
        $this->assertObjectHasProperty('status', $updateData);
        $this->assertObjectHasProperty('priority', $updateData);
        $this->assertObjectHasProperty('title', $updateData);
        $this->assertObjectHasProperty('description', $updateData);
    }

    /**
     * @return void
     * @depends testGetUpdateDataClass
     */
    public function testGetId()
    {
        $this->assertEquals(
            expected: 10,
            actual: $this->testGetUpdateDataClass()->getId()
        );
    }

    /**
     * @return void
     * @depends testGetUpdateDataClass
     */
    public function testGetData()
    {
        $this->assertEquals(
            expected: collect([
                'id' => 10,
                'parent_id' => 2,
                'status' => 'todo',
                'priority' => 5,
                'title' => 'test',
                'description' => 'New Test'
            ]),
            actual: $this->testGetUpdateDataClass()->getData()
        );
    }
}
