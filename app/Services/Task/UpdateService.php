<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\Task\UpdateDataFactory;
use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;

class UpdateService extends AbstractService
{
    public function __construct(
        protected UpdateDataFactory $updateDataFactory,
        protected TaskRepository    $task,
        protected ResponseService   $response,
    )
    {
    }

    public function update(): ResponseService
    {
        $data = $this->updateDataFactory->getValidData();

        $result = $this->task->updateById($data);

        if (!$result) {
            throw new ServiceException(__('task.not_found', ['id' => $data->getId()]),);
        }
        $result = $this->task->getById($data->getId());

        $this->response->setUpdateData($result);

        return $this->response;
    }
}
