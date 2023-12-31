<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\TaskDataFactory;
use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;

class  IndexService extends AbstractService
{
    public function __construct(
        protected TaskDataFactory $dataFactory,
        protected TaskRepository  $task,
        protected ResponseService $response,
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
            throw new ServiceException(__('task.index_filter_fail'),);
        } else {
            $this->response->setIndexData($data);
        }
        return $this->response;
    }
}
