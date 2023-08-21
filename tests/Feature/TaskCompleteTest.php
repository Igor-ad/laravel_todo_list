<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskCompleteTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_set_complete_successful
     */
    public function test_task_set_complete_successful(): void
    {
        $this->init();

        $response = $this->put(uri: sprintf(
            "%s%d?api_token=%s",
            Path::complete->value,
            $this->task->id,
            $this->user->api_token
        ));

        $response->assertStatus(200);
    }

    /**
     * test_attempt_completed_task_if_task_not_exists
     */
    public function test_attempt_completed_task_if_task_not_exists(): void
    {
        $this->userInit();

        $response = $this->put(uri: sprintf(
            "%s%d?api_token=%s",
            Path::complete->value,
            0,
            $this->user->api_token
        ));

        $response->assertStatus(500);
    }

    /**
     * test_task_set_complete_with_children_are_status_done
     */
    public function test_task_set_complete_with_children_are_status_done(): void
    {
        $this->init();
        $taskId = $this->task->id;

        $this->task = Task::factory()->create([
            'parent_id' => $this->task->id,
            'user_id' => $this->user->id,
            'status' => TaskStatusEnum::DONE->value,
        ]);

        $response = $this->put(uri: sprintf(
            "%s%d?api_token=%s",
            Path::complete->value,
            $taskId,
            $this->user->api_token
        ));

        $this->deleteTask($taskId);

        $response->assertStatus(501);
    }
}
