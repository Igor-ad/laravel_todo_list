<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\Task\IndexDataFactory;
use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\CommonService;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Cache;

class  IndexService extends CommonService
{
    public function __construct(
        protected IndexDataFactory $dataFactory,
        protected TaskRepository   $task,
        protected ResponseService  $response,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function index(): ResponseService
    {
        $data = $this->dataFactory->getValidData();

        $taskData = match (true) {
            $data->hasSort() && !$data->hasTxtFilter() => $this->task->getOrder($data),
            !$data->hasSort() && $data->hasTxtFilter() => $this->task->getAllFilter($data),
            $data->hasSort() && $data->hasTxtFilter() => $this->task->getOrderAllFilter($data),
            default => $this->task->get($data),
        };

        if (($taskData->isEmpty())) {
            throw new ServiceException(__('task.index_filter_fail'),);
        }
        return $this->response->setIndexData($taskData);
    }
}
