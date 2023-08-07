<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskMarkedDoneRepository;

class TaskMarkedDoneService
{

    /**
     * @param TaskMarkedDoneRepository $repository
//     * @param Task $task
     */
    public function __construct(
        protected TaskMarkedDoneRepository $repository,
//        protected Task                     $task,
    )
    {
    }

    /**
     * @param Task $task
     * @return array
     */
    protected function childStatus(Task $task): array
    {
        $id = $task->getOriginal('id');
        return $this->repository->getTaskChildStatus([$id, $id]);
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function decisionChildTodo(Task $task): bool
    {
        return (!empty($this->childStatus($task)));
    }

    public function setTaskStatusDone(Task $task)
    {
        $this->repository->taskMarkedDone($task);
    }
}
