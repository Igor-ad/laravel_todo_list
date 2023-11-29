<?php

declare(strict_types=1);

namespace Data;

use App\Data\Request\TaskUpdateData;
use PHPUnit\Framework\TestCase;

class TaskUpdateDataTest extends TestCase
{
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

    public function test__construct(): void
    {
        $updateData = $this->testGetUpdateDataClass();

        $this->assertObjectHasProperty('id', $updateData);
        $this->assertObjectHasProperty('parent_id', $updateData);
        $this->assertObjectHasProperty('status', $updateData);
        $this->assertObjectHasProperty('priority', $updateData);
        $this->assertObjectHasProperty('title', $updateData);
        $this->assertObjectHasProperty('description', $updateData);
    }

    public function testGetId(): void
    {
        $this->assertEquals(
            expected: 10,
            actual: $this->testGetUpdateDataClass()->getId()
        );
    }

    public function testGetData(): void
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
