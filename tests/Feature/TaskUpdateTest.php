<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * test_task_update_path_successful_access
     */
    public function test_task_update_path_successful_access(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->put(sprintf("/api/tasks/update/?api_token=%s&id=%d", $user->api_token, $task->id));

        $response->assertStatus(200);
    }

    /**
     * test_task_update_successfully
     */
    public function test_task_update_successfully(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->put(sprintf("/api/tasks/update/?api_token=%s&id=%d&title=TEST", $user->api_token, $task->id));

        $response->assertStatus(200);
    }
}
