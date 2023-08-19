<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCompleteTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * test_task_set_complete_successful
     */
    public function test_task_set_complete_successful(): void
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->put(sprintf("/api/tasks/complete/%d?api_token=%s", $task->id, $user->api_token));

        $response->assertStatus(200);
    }
}
