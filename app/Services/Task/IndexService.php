<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\TaskDataFactory;
use App\Repositories\TaskRepository;
use App\Services\ResponseService;
use RuntimeException;

class IndexService
{
    public function __construct(
        protected TaskRepository  $repository,
        protected ResponseService $response,
        protected TaskDataFactory $dataFactory,
    )
    {
    }

    public function index(): ResponseService
    {
        $data = $this->dataFactory->getValidData();

        $data = match (true) {
            $data->hasSort() && !$data->hasTxtFilter() => $this->repository->getOrder($data),
            !$data->hasSort() && $data->hasTxtFilter() => $this->repository->getAllFilter($data),
            $data->hasSort() && $data->hasTxtFilter() => $this->repository->getOrderAllFilter($data),
            default => $this->repository->get($data),
        };

        if (($data->isEmpty())) {
            throw new RuntimeException(
                message: __('task.index_filter_fail'),
            );
        } else {
            $this->response->setTaskIndexData($data);
        }
        return $this->response;
    }
}
