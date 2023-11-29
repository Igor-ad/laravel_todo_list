<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Task;
use App\Models\User;

trait TaskTestHelper
{
    protected User $user;
    protected Task $task;

    protected function init(): void
    {
        $this->setUser();
        $this->setTask();
    }

    protected function userInit(): void
    {
        $this->setUser();
    }

    private function setTask(): void
    {
        $this->task = Task::factory()->create(['user_id' => $this->user->getAttribute('id')]);
    }

    private function setUser(): void
    {
        $this->user = User::factory()->create();
    }

    private function deleteTask(int $id): int
    {
        return Task::where('id', '=', $id)->delete();
    }

    /**
     *  Clean testing database after complete future test
     *  instead of the slow "use RefreshDatabase" trait
     */
    public function __destruct()
    {
        $this->user->delete();
        unset($this->user);

        if (isset($this->task)) {
            $this->task->delete();
            unset($this->task);
        }
    }
}
