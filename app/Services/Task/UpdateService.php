<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\Task\UpdateDataFactory;
use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\CommonService;
use App\Services\ResponseService;

class UpdateService extends CommonService
{
    public function __construct(
        protected UpdateDataFactory $updateDataFactory,
        protected TaskRepository    $task,
        protected ResponseService   $response,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function update(): ResponseService
    {
        $data = $this->updateDataFactory->getValidData();

        if ($this->task->updateById($data)) {
            $result = $this->task->getById($data->getId());

            return $this->response->setUpdateData($result);
        }
        throw new ServiceException(__('task.update_fail', ['id' => $data->getId()]),);
    }
}
