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
     * test_the_task_status_set_complete_successfully
     */
    public function test_the_task_status_set_complete_successfully(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->put(uri: sprintf(
            "%s%d?api_token=%s",
            Path::API->value . Path::complete->value,
            $this->task->getAttribute('id'),
            $this->user->getAttribute('api_token'),
        ))->assertStatus(200);
    }

    /**
     * test_attempt_to_set_task_status_to_complete_if_task_does_not_exist
     */
    public function test_attempt_to_set_task_status_to_complete_if_task_does_not_exist(): void
    {
        $this->userInit();

        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->put(uri: sprintf(
            "%s%d?api_token=%s",
            Path::API->value . Path::complete->value,
            0,
            $this->user->getAttribute('api_token'),
        ))->assertStatus(500);
    }

    /**
     * test_attempt_to_set_task_status_to_complete_if_children_are_status_todo
     */
    public function test_attempt_to_set_task_status_to_complete_if_children_are_status_todo(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $taskId = $this->task->getAttribute('id');

        $this->task = Task::factory()->create([
            'parent_id' => $this->task->getAttribute('id'),
            'user_id' => $this->user->getAttribute('id'),
            'status' => TaskStatusEnum::DONE->value,
        ]);

        $response = $this->put(uri: sprintf(
            "%s%d?api_token=%s",
            Path::API->value . Path::complete->value,
            $taskId,
            $this->user->getAttribute('api_token'),
        ));

        $this->deleteTask($taskId);

        $response->assertStatus(501);
    }
}
