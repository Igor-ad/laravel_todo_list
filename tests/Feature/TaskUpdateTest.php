<?php

declare(strict_types=1);

namespace Tests\Feature;

use Symfony\Component\HttpFoundation\Response;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{
    use TaskTestHelper;

    public function test_attempt_updated_the_task_with_wrong_id(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->put(uri: sprintf(
            "%s?api_token=%s&id=%d&title=%s",
            route('api.update'),
            $this->user->getAttribute('api_token'),
            0,
            fake()->jobTitle
        ))->assertStatus(Response::HTTP_NOT_IMPLEMENTED);
    }

    public function test_the_task_was_updated_successfully(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->put(uri: sprintf(
            "%s?api_token=%s&id=%d&title=%s",
            route('api.update'),
            $this->user->getAttribute('api_token'),
            $this->task->getAttribute('id'),
            fake()->jobTitle
        ))->assertOk();
    }

    public function test_attempt_updated_the_task_with_wrong_field(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->put(uri: sprintf(
            "%s?api_token=%s&id=%d&status=%s",
            route('api.update'),
            $this->user->getAttribute('api_token'),
            $this->task->getAttribute('id'),
            'OK'
        ))->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
