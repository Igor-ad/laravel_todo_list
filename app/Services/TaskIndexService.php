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
     * @param bool $filter
     * @return Collection
     */
    public function getTasks(object $data, bool $filter): Collection
    {
        if (!$filter && !$this->titleExist($data)) {
            $tasks = $this->repository->getOrderUserTasks($data);

        } elseif ($filter && $this->titleExist($data)) {
            $tasks = $this->repository->getAllFilterUserTasks($data);

        } elseif (!$filter && $this->titleExist($data)) {
            $tasks = $this->repository->getOrderAllFilterUserTasks($data);

        } else {
            $tasks = $this->repository->getUserTasks($data);
        }

        return $tasks;
    }

    /**
     * @param object $data
     * @return bool
     */
    private function titleExist(object $data): bool
    {
        return property_exists($data, 'title');
    }

}
