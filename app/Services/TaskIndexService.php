<?php

namespace App\Services;

use App\Data\Request\TaskIndexData;
use App\Repositories\TaskRepository;

class TaskIndexService
{

    public function __construct(
        protected TaskRepository  $repository,
        protected TaskIndexData   $taskIndexData,
        protected ResponseService $response,
    )
    {
    }

    /**
     * @param TaskIndexData $data
     * @return ResponseService
     */
    public function index(TaskIndexData $data): ResponseService
    {
        $data = match (true) {
            $data->hasSort() && !$data->hasTxtFilter() => $this->repository->getOrder($data),
            !$data->hasSort() && $data->hasTxtFilter() => $this->repository->getAllFilter($data),
            $data->hasSort() && $data->hasTxtFilter() => $this->repository->getOrderAllFilter($data),
            default => $this->repository->get($data),
        };

        ($data->isEmpty())
            ? $this->response->setTaskIndexFailData($data)
            : $this->response->setTaskIndexData($data);

        return $this->response;
    }

}
