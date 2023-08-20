<?php

namespace Tests\Feature;

use App\Enums\TaskRouteEnum as Route;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskCreateTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_sample_create_successful
     */
    public function test_task_sample_create_successful(): void
    {
        $this->userInit();

        $response = $this->post(uri: sprintf(
            '%s?api_token=%s&parent_id=%d&status=%s&priority=%d&title=%s&description=%s',
            Route::create->value,
            $this->user->api_token,
            1, 'todo', 1,
            fake()->jobTitle,
            fake()->paragraph(1)
        ));

        $this->deleteTask($response->json(0)['data']['id']);

        $response->assertStatus(201);
    }
}
