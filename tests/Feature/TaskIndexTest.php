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
        $this->init();

        $response = $this->get(uri: sprintf(
            "%s?api_token=%s",
            Path::API->value . Path::index->value,
            $this->user->getAttribute('api_token'),
        ));

        $response->assertStatus(200);
    }

    /**
     * test_attempt_to_access_to_the_wrong_path
     */
    public function test_attempt_to_access_to_the_wrong_path(): void
    {
        $this->userInit();

        $response = $this->get(uri: sprintf(
            "%s?api_token=%s",
            '/api/tasks/wrong_path/',
            $this->user->getAttribute('api_token'),
        ));

        $response->assertStatus(404);
    }

    /**
     * test_attempt_unauthorized_access_to_task_index_path
     */
    public function test_attempt_unauthorized_access_to_the_task_index_path(): void
    {
        $this->userInit();

        $response = $this->get(uri: sprintf(
            "%s?api_token=%s",
            Path::API->value . Path::index->value,
            '**********'
        ));

        $response->assertStatus(401);
    }
}
