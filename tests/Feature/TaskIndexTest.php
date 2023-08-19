<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * test_task_index_path_successful_access
     */
    public function test_task_index_path_successful_access(): void
    {
        $user = User::factory()->create();

        $response = $this->get(sprintf("/api/tasks/?api_token=%s", $user->api_token));

        $response->assertStatus(200);
    }
}
