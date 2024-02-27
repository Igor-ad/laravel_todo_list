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
        if ($this->hasChildrenStatusTodo($id)) {
            throw new ServiceException(__('task.complete_fail', ['id' => $id]),);
        }
        $this->response->setCompleteData($id, $this->setCompleteStatus($id));

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    protected function hasChildrenStatusTodo(int $id): bool
    {
        return (bool)$this->checkChildrenStatus($id)->getAttribute('children_count');
    }

    /**
     * @throws ServiceException
     */
    public function checkChildrenStatus(int $id): ?Task
    {
        return $this->checkOnException(
            $this->task->hasChildrenStatusTodo($id), $id
        );
    }

    /**
     * @throws ServiceException
     */
    public function setCompleteStatus(int $id): int
    {
        return $this->checkOnException(
            $this->task->complete($id), $id
        );
    }

    /**
     * @throws ServiceException
     */
    private function checkOnException(mixed $data, int $id): null|int|Task
    {
        if ($data) {
            return $data;
        }
        throw new ServiceException(__('task.not_found', ['id' => $id]),);
    }
}
