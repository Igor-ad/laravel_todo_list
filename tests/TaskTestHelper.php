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
        $this->task = Task::factory()->create(['user_id' => $this->user->getAttribute('id')]);
    }

    /**
     * @return void
     */
    private function setUser(): void
    {
        $this->user = User::factory()->create();
    }

    /**
     * @param int $id
     * @return bool
     */
    private function deleteTask(int $id): bool
    {
        return Task::where('id', '=', $id)->delete();
    }

    /**
     *  Clean testing database after complete future test
     *  instead of the slow "use RefreshDatabase" trait
     *
     * @return void
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
