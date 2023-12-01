<?php

declare(strict_types=1);

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskIndexTest extends TestCase
{
    use TaskTestHelper;

    public function test_successful_access_to_task_index_path(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->get(uri: sprintf(
            "%s?api_token=%s",
            route('api.index'),
            $this->user->getAttribute('api_token'),
        ))->assertOk();
    }

    public function test_attempt_to_access_to_the_wrong_path(): void
    {
        $this->userInit();

        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->get(uri: sprintf(
            "%s?api_token=%s",
            '/api/tasks/wrong_path/',
            $this->user->getAttribute('api_token'),
        ))->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_attempt_unauthorized_access_to_the_task_index_path(): void
    {
        $this->userInit();

        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->get(uri: sprintf(
            "%s?api_token=%s",
            route('api.index'),
            '**********'
        ))->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
