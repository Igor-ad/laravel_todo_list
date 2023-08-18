<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_task_index_path_successful_access(): void
    {
        $response = $this->get('/api/tasks/?api_token=**********');

        $response->assertStatus(200);
    }
}
