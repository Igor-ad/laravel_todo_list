<?php

declare(strict_types=1);

namespace Data;

use App\Data\Request\TaskCreateData;
use PHPUnit\Framework\TestCase;

class TaskCreateDataTest extends TestCase
{
    public function testGetTaskCreateDataClass(): TaskCreateData
    {
        $taskCreateData = new TaskCreateData(
            status: 'todo',
            priority: 3,
            title: 'test',
            description: 'New Test',
            parent_id: 2,
        );

        $this->assertTrue(is_a($taskCreateData, 'App\Data\Request\TaskCreateData'));

        return $taskCreateData;

    }

    public function test__construct(): void
    {
        $taskCreateData = $this->testGetTaskCreateDataClass();

        $this->assertObjectHasProperty('status', $taskCreateData);
        $this->assertObjectHasProperty('priority', $taskCreateData);
        $this->assertObjectHasProperty('title', $taskCreateData);
        $this->assertObjectHasProperty('description', $taskCreateData);
        $this->assertObjectHasProperty('parent_id', $taskCreateData);
    }

    public function testGetData(): void
    {
        $this->assertEquals(
            expected: collect([
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
