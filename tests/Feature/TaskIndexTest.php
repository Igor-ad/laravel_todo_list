<?php

namespace Tests\Feature;

use App\Enums\TaskRouteEnum as Route;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_index_path_successful_access
     */
    public function test_task_index_path_successful_access(): void
    {
        $this->init();

        $response = $this->get(uri: sprintf(
            "%s?api_token=%s",
            Route::index->value,
            $this->user->api_token
        ));

        $response->assertStatus(200);
    }
}
