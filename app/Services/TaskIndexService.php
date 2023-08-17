<?php

namespace App\Services;

use App\Data\TaskIndexData;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskIndexService
{

    public function __construct(
        protected TaskRepository $repository,
        protected TaskIndexData $taskIndexData,
    )
    {
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function index(TaskIndexData $data): ?Collection
    {
        return match (true) {
            $data->hasSort() && !$data->hasTxtFilter() => $this->repository->getOrder($data),
            !$data->hasSort() && $data->hasTxtFilter() => $this->repository->getAllFilter($data),
            $data->hasSort() && $data->hasTxtFilter() => $this->repository->getOrderAllFilter($data),
            default => $this->repository->get($data),
        };
    }

}
