<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(
        protected TaskRepository $repository,
    )
    {
    }

    /**
     * @param Task $task
     * @return mixed
     */
    public function show(Task $task): mixed
    {
        return $this->repository->showTask($task);
    }

    /**
     * @return mixed
     */
    public function update(): mixed
    {
        $this->repository->updateTask();

        return $this->repository->getTask();
    }

    /**
     * @return mixed
     */
    public function add(): mixed
    {
        return $this->repository->storeTask();
    }

    /**
     * @param Task $task
     * @return mixed
     */
    public function del(Task $task): mixed
    {
        if ($this->repository->doneStatusTask($task)) {
            return $this->repository->doneStatusTask($task);
        } else {
            return $this->repository->eraseTask($task);
        }
    }

}
