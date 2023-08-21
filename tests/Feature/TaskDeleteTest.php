<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
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
            Path::delete->value,
            $this->task->id,
            $this->user->api_token
        ));

        $response->assertStatus(200);
    }

    /**
     * the_test_task_is_not_exists
     */
    public function test_attempt_deleted_task_if_task_is_not_exists(): void
    {
        $this->init();

        $response = $this->delete(uri: sprintf(
            '%s%d?api_token=%s',
            Path::delete->value,
            0,
            $this->user->api_token
        ));

        $response->assertStatus(500);
    }

    /**
     * test_task_status_is_done
     */
    public function test_attempt_deleted_task_with_status_is_complete(): void
    {
        $this->userInit();

        $this->task = Task::factory()->create([
            'user_id' => $this->user->id,
            'status' => TaskStatusEnum::DONE->value,
        ]);

        $response = $this->delete(uri: sprintf(
            '%s%d?api_token=%s',
            Path::delete->value,
            $this->task->id,
            $this->user->api_token
        ));

        $response->assertStatus(501);
    }
}
