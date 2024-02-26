<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\ServiceException;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\CommonService;
use App\Services\ResponseService;

class CompleteService extends CommonService
{
    public function __construct(
        protected TaskRepository  $task,
        protected ResponseService $response,
    )
    {
    }

    /**
     * @throws ServiceException
     */
    public function complete(int $id): ResponseService
    {
        if (!$this->checkChildrenStatus($id)->getAttribute('children_count')) {
            $this->response->setCompleteData(
                $id, $this->setCompleteStatus($id)
            );
        } else {
            throw new ServiceException(__('task.complete_fail', ['id' => $id]),);
        }
        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    public function checkChildrenStatus(int $id): ?Task
    {
        $data = $this->task->hasChildrenStatusTodo($id);

        if (!$data) {
            throw new ServiceException(__('task.not_found', ['id' => $id]));
        }
        return $data;
    }

    /**
     * @throws ServiceException
     */
    public function setCompleteStatus(int $id): int
    {
        $data = $this->task->complete($id);

        if (!$data) {
            throw new ServiceException(__('task.not_found', ['id' => $id]),);
        }
        return $data;
    }
}
