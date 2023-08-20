<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_update_path_successful_access
     */
    public function test_task_update_path_successful_access(): void
    {
        $this->init();

        $response = $this->put(uri: sprintf(
            "%s?api_token=%s&id=%d",
            Path::update->value,
            $this->user->api_token,
            $this->task->id
        ));

        $response->assertStatus(200);
    }

    /**
     * test_task_update_successfully
     */
    public function test_task_update_successfully(): void
    {
        $this->init();

        $response = $this->put(uri: sprintf(
            "%s?api_token=%s&id=%d&title=%s",
            Path::update->value,
            $this->user->api_token,
            $this->task->id,
            fake()->jobTitle
        ));

        $response->assertStatus(200);
    }
}
