<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskMarkedDoneService
{

    /**
     * @param TaskRepository $repository
     */
    public function __construct(
        protected TaskRepository $repository,
    )
    {
    }

    /**
     * @param object $data
     * @return array
     */
    protected function childStatus(object $data): array
    {
        return $this->repository->getTaskChildStatus([$data->id, $data->id]);
    }

    /**
     * @param object $data
     * @return bool
     */
    public function decisionChildTodo(object $data): bool
    {
        $status = empty($this->childStatus($data));
        if ($status) {
            $this->setTaskStatusDone($data->id);
        }
        return $status;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function setTaskStatusDone(int $id): mixed
    {
        return $this->repository->taskMarkedDone($id);
    }
}
