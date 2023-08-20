<?php

namespace Tests\Feature;

use App\Enums\TaskRouteEnum as Route;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskShowTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_show_complete_successful
     */
    public function test_task_show_complete_successful(): void
    {
        $this->init();

        $response = $this->get(uri: sprintf(
            '%s%d?api_token=%s',
            Route::show->value,
            $this->task->id,
            $this->user->api_token
        ));

        $response->assertStatus(200);
    }
}
