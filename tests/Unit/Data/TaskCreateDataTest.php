<?php

namespace Data;

use App\Data\Request\TaskCreateData;
use PHPUnit\Framework\TestCase;

class TaskCreateDataTest extends TestCase
{
    /**
     * @return TaskCreateData
     */
    public function testGetTaskCreateDataClass(): TaskCreateData
    {
        $taskCreateData = new TaskCreateData(
            user_id: 1,
            status: 'todo',
            priority: 3,
            title: 'test',
            description: 'New Test',
            parent_id: 2,
        );

        $this->assertTrue(is_a($taskCreateData, 'App\Data\Request\TaskCreateData'));

        return $taskCreateData;

    }

    /**
     * @return void
     * @depends testGetTaskCreateDataClass
     */
    public function test__construct()
    {
        $taskCreateData = $this->testGetTaskCreateDataClass();

        $this->assertObjectHasProperty('user_id', $taskCreateData);
        $this->assertObjectHasProperty('status', $taskCreateData);
        $this->assertObjectHasProperty('priority', $taskCreateData);
        $this->assertObjectHasProperty('title', $taskCreateData);
        $this->assertObjectHasProperty('description', $taskCreateData);
        $this->assertObjectHasProperty('parent_id', $taskCreateData);
    }

    /**
     * @return void
     * @depends testGetTaskCreateDataClass
     */
    public function testGetData()
    {
        $this->assertEquals(
            expected: collect([
                'user_id' => 1,
                'status' => 'todo',
                'priority' => 3,
                'title' => 'test',
                'description' => 'New Test',
                'parent_id' => 2,
            ]),
            actual: $this->testGetTaskCreateDataClass()->getData()
        );
    }
}
