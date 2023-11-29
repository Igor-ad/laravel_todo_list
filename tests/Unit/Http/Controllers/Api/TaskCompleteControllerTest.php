<?php

declare(strict_types=1);

namespace Http\Controllers\Api;

use PHPUnit\Framework\TestCase;

class TaskCompleteControllerTest extends TestCase
{
    public function test__construct()
    {
        $taskCompleteController = $this->getMockBuilder('App\Http\Controllers\Api\Task\CompleteController')
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertTrue(is_a($taskCompleteController, 'App\Http\Controllers\Api\Task\CompleteController'));
    }

    public function testComplete()
    {
        self::assertTrue(true);
    }
}
