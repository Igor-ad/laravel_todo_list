<?php

namespace Tests;

use App\Models\Task;
use App\Models\User;

trait TaskTestHelper
{
    protected User $user;
    protected Task $task;

    /**
     * @return void
     */
    protected function init(): void
    {
        $this->setUser();
        $this->setTask();
    }

    /**
     * @return void
     */
    protected function userInit(): void
    {
        $this->setUser();
    }

    /**
     * @return void
     */
    private function setTask(): void
    {
        $this->task = Task::factory()->create(['user_id' => $this->user->id]);
    }

    /**
     * @return void
     */
    private function setUser(): void
    {
        $this->user = User::factory()->create();
    }

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->user->delete();
        $this->task->delete();
        unset($this->task);
        unset($this->user);
    }
}
