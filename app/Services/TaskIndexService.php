<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskIndexService
{

    public function __construct(
        protected TaskRepository $repository,
    )
    {
    }

    /**
     * @param object $data
     * @param bool $order
     * @return Collection
     */
    public function getTasks(object $data, bool $order): Collection
    {
        return match (true) {
            !$order && !isset($data->title) => $this->repository->getOrderUserTasks($data),
            $order && isset($data->title) => $this->repository->getAllFilterUserTasks($data),
            !$order && isset($data->title) => $this->repository->getOrderAllFilterUserTasks($data),
            default => $this->repository->getUserTasks($data),
        };
    }

}
