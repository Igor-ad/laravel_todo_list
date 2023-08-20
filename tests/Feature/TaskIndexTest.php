<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_task_index_path_successful_access
     */
    public function test_task_index_path_successful_access(): void
    {
        $this->userInit();

        $response = $this->get(uri: sprintf(
            "%s?api_token=%s",
            Path::index->value,
            $this->user->api_token
        ));

        $response->assertStatus(200);
    }
}
