<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
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
}
