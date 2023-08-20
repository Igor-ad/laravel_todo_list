<?php

namespace Tests\Feature;

use App\Enums\TaskRouteEnum as Route;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskDeleteTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_delete_successful
     */
    public function test_task_delete_successful(): void
    {
        $this->init();

        $response = $this->delete(uri: sprintf(
            '%s%d?api_token=%s',
            Route::delete->value,
            $this->task->id,
            $this->user->api_token
        ));

        $response->assertStatus(200);
    }
}
