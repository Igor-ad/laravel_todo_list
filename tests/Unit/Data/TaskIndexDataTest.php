<?php

namespace Data;

use App\Data\Request\TaskIndexData;
use PHPUnit\Framework\TestCase;

class TaskIndexDataTest extends TestCase
{
    /**
     * @return TaskIndexData
     */
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

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function test__construct()
    {
        $indexData = $this->testGetTaskIndexData();

        $this->assertObjectHasProperty('status', $indexData);
        $this->assertObjectHasProperty('priority', $indexData);
        $this->assertObjectHasProperty('prioritySort', $indexData);
        $this->assertObjectHasProperty('createdSort', $indexData);
        $this->assertObjectHasProperty('completedSort', $indexData);
    }

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function testGetData()
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

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function testGetFilter()
    {
        $this->assertEquals(
            expected: collect([
                'status' => 'todo',
                'priority' => 2,
            ]),
            actual: $this->testGetTaskIndexData()->getFilter()
        );
    }

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function testGetSort()
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

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function testGetTitle()
    {
        $this->assertEquals(
            expected: 'test',
            actual: $this->testGetTaskIndexData()->getTitle()
        );
    }

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function testHasSort()
    {
        $this->assertTrue($this->testGetTaskIndexData()->hasSort());
    }

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function testHasTxtFilter()
    {
        $this->assertTrue($this->testGetTaskIndexData()->hasTxtFilter());
    }

    /**
     * @return void
     * @depends testGetTaskIndexData
     */
    public function testHasFilter()
    {
        $this->assertTrue($this->testGetTaskIndexData()->hasFilter());
    }
}
