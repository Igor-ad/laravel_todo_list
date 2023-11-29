<?php

declare(strict_types=1);

namespace Data;

use App\Data\Request\TaskIndexData;
use PHPUnit\Framework\TestCase;

class TaskIndexDataTest extends TestCase
{
    public function testGetTaskIndexData(): TaskIndexData
    {
        $indexData = new TaskIndexData(
            status: 'todo',
            priority: 2,
            title: 'test',
            prioritySort: 'up',
            createdSort: 'dw',
            completedSort: 'up',
        );
        $this->assertTrue(is_a($indexData, 'App\Data\Request\TaskIndexData'));

        return $indexData;
    }

    public function test__construct(): void
    {
        $indexData = $this->testGetTaskIndexData();

        $this->assertObjectHasProperty('status', $indexData);
        $this->assertObjectHasProperty('priority', $indexData);
        $this->assertObjectHasProperty('prioritySort', $indexData);
        $this->assertObjectHasProperty('createdSort', $indexData);
        $this->assertObjectHasProperty('completedSort', $indexData);
    }

    public function testGetData(): void
    {
        $this->assertEquals(
            expected: collect([
                'status' => 'todo',
                'priority' => 2,
                'prioritySort' => 'up',
                'createdSort' => 'dw',
                'completedSort' => 'up',
            ]),
            actual: $this->testGetTaskIndexData()->getData()
        );
    }

    public function testGetFilter(): void
    {
        $this->assertEquals(
            expected: collect([
                'status' => 'todo',
                'priority' => 2,
            ]),
            actual: $this->testGetTaskIndexData()->getFilter()
        );
    }

    public function testGetSort(): void
    {
        $this->assertEquals(
            expected: collect([
                'prioritySort' => 'up',
                'createdSort' => 'dw',
                'completedSort' => 'up',
            ]),
            actual: $this->testGetTaskIndexData()->getSort()
        );
    }

    public function testGetTitle(): void
    {
        $this->assertEquals(
            expected: 'test',
            actual: $this->testGetTaskIndexData()->getTitle()
        );
    }

    public function testHasSort(): void
    {
        $this->assertTrue($this->testGetTaskIndexData()->hasSort());
    }

    public function testHasTxtFilter(): void
    {
        $this->assertTrue($this->testGetTaskIndexData()->hasTxtFilter());
    }

    public function testHasFilter(): void
    {
        $this->assertTrue($this->testGetTaskIndexData()->hasFilter());
    }
}
