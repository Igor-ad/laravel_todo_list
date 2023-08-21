<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_successful_access_to_task_index_path
     */
    public function test_successful_access_to_task_index_path(): void
    {
        $this->userInit();

        $response = $this->get(uri: sprintf(
            "%s?api_token=%s",
            Path::index->value,
            $this->user->api_token
        ));

        $response->assertStatus(200);
    }

    /**
     * test_attempt_unauthorized_access_to_task_index_path
     */
    public function test_attempt_unauthorized_access_to_the_task_index_path(): void
    {
        $this->userInit();

        $response = $this->get(uri: sprintf(
            "%s?api_token=%s",
            Path::index->value,
            '**********'
        ));

        $response->assertStatus(401);
    }
}
