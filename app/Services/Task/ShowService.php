<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\TaskServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;

class ShowService extends AbstractService
{
    public function __construct(
        protected TaskRepository  $task,
        protected ResponseService $response,
    )
    {
    }

    public function show(int $id): ResponseService
    {
        $result = $this->task->getById($id);

        if ($result) {
            $this->response->setTaskShowData($id, $result);
        } else {
            throw new TaskServiceException(
                message: __('task.not_found', ['id' => $id]),
            );
        }
        return $this->response;
    }
}
