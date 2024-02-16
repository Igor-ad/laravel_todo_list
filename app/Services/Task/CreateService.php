<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\Task\CreateDataFactory;
use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\CommonService;
use App\Services\ResponseService;

class CreateService extends CommonService
{
    public function __construct(
        protected CreateDataFactory $createDataFactory,
        protected TaskRepository    $task,
        protected ResponseService   $response,
    )
    {
    }

    public function create(): ResponseService
    {
        $data = $this->createDataFactory->getValidData();

        $result = $this->task->create($data);

        if (!$result) {
            throw new ServiceException(__('task.create_fail'));
        }

        $this->response->setCreateData($result);

        return $this->response;
    }
}
