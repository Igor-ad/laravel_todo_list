<?php

namespace App\Services;

use App\Data\TaskIndexData;
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

        if ($data->isEmpty()) $this->response->setTaskIndexFailData($data);
        else $this->response->setTaskIndexData($data);

        return $this->response;
    }

}
