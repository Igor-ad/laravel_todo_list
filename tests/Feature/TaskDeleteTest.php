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
     * test_the_task_was_deleted_successfully
     */
    public function test_the_task_was_deleted_successfully(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->delete(uri: sprintf(
            '%s%d?api_token=%s',
            Path::API->value . Path::delete->value,
            $this->task->getAttribute('id'),
            $this->user->getAttribute('api_token'),
        ))->assertStatus(200);
    }

    /**
     * test_attempt_to_delete_task_if_task_does_not_exist
     */
    public function test_attempt_to_delete_task_if_task_does_not_exist(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->delete(uri: sprintf(
            '%s%d?api_token=%s',
            Path::API->value . Path::delete->value,
            0,
            $this->user->getAttribute('api_token'),
        ))->assertStatus(500);
    }

    /**
     * test_attempt_to_delete_task_with_its_status_is_complete
     */
    public function test_attempt_to_delete_task_with_its_status_is_complete(): void
    {
        $this->userInit();

        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->task = Task::factory()->create([
            'user_id' => $this->user->id,
            'status' => TaskStatusEnum::DONE->value,
        ]);

        $this->assertDatabaseHas('tasks', $this->task->toArray());

        $this->delete(uri: sprintf(
            '%s%d?api_token=%s',
            Path::API->value . Path::delete->value,
            $this->task->getAttribute('id'),
            $this->user->getAttribute('api_token'),
        ))->assertStatus(501);
    }
}
