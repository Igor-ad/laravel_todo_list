<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\TaskDataFactory;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;
use RuntimeException;

class IndexService extends AbstractService
{
    public function __construct(
        protected TaskRepository  $task,
        protected ResponseService $response,
        protected TaskDataFactory $dataFactory,
    )
    {
    }

    public function index(): ResponseService
    {
        $data = $this->dataFactory->getValidData();

        $data = match (true) {
            $data->hasSort() && !$data->hasTxtFilter() => $this->task->getOrder($data),
            !$data->hasSort() && $data->hasTxtFilter() => $this->task->getAllFilter($data),
            $data->hasSort() && $data->hasTxtFilter() => $this->task->getOrderAllFilter($data),
            default => $this->task->get($data),
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
