<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
use Symfony\Component\HttpFoundation\Response;
use Tests\TaskTestHelper;
use Tests\TestCase;

class TaskShowTest extends TestCase
{
    use TaskTestHelper;

    /**
     * test_the_task_was_shown_successfully
     */
    public function test_the_task_was_shown_successfully(): void
    {
        $this->init();

        $this->assertDatabaseHas('tasks', $this->task->toArray());
        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->get(uri: sprintf(
            '%s%d?api_token=%s',
            Path::API->value . Path::show->value,
            $this->task->getAttribute('id'),
            $this->user->getAttribute('api_token'),
        ))->assertStatus(Response::HTTP_OK);
    }

    /**
     * test_the_task_id_is_not_found_in_the_system
     */
    public function test_the_task_id_is_not_found_in_the_system(): void
    {
        $this->userInit();

        $this->assertDatabaseHas('users', $this->user->toArray());

        $this->get(uri: sprintf(
            '%s%d?api_token=%s',
            Path::API->value . Path::show->value,
            0,
            $this->user->getAttribute('api_token'),
        ))->assertStatus(Response::HTTP_NOT_IMPLEMENTED);
    }
}
