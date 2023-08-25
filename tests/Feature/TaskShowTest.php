<?php

namespace Tests\Feature;

use App\Enums\TaskPathEnum as Path;
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

        $this->get(uri: sprintf(
            '%s%d?api_token=%s',
            Path::show->value,
            $this->task->getAttribute('id'),
            $this->user->getAttribute('api_token'),
        ))->assertStatus(200);
    }

    /**
     * test_the_task_id_is_not_found_in_the_system
     */
    public function test_the_task_id_is_not_found_in_the_system(): void
    {
        $this->userInit();

        $this->get(uri: sprintf(
            '%s%d?api_token=%s',
            Path::show->value,
            0,
            $this->user->getAttribute('api_token'),
        ))->assertStatus(501);
    }
}
