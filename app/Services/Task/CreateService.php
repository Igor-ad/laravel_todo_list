<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\TaskCreateDataFactory;
use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;

class CreateService extends AbstractService
{
    public function __construct(
        protected TaskCreateDataFactory $createDataFactory,
        protected TaskRepository        $task,
        protected ResponseService       $response,
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

        $this->response->setTaskCreateData($result);

        return $this->response;
    }
}
