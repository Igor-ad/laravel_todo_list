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
    public function index(object $data, bool $order): Collection
    {
        return match (true) {
            !$order && !isset($data->title) => $this->repository->getOrder($data),
            $order && isset($data->title) => $this->repository->getAllFilter($data),
            !$order && isset($data->title) => $this->repository->getOrderAllFilter($data),
            default => $this->repository->get($data),
        };
    }

}
