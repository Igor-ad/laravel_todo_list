<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_successful_access_to_the_task_update_path
     */
    public function test_successful_access_to_the_task_update_path(): void
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
     * test_the_task_was_updated_successfully
     */
    public function test_the_task_was_updated_successfully(): void
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

    /**
     * test_attempt_updated_the_task_with_wrong_field
     */
    public function test_attempt_updated_the_task_with_wrong_field(): void
    {
        $this->init();

        $response = $this->put(uri: sprintf(
            "%s?api_token=%s&id=%d&status=%s",
            Path::update->value,
            $this->user->api_token,
            $this->task->id,
            'OK'
        ));

        $response->assertStatus(422);
    }
}
