<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;

class CompleteService extends AbstractService
{
    public function __construct(
        protected TaskRepository  $task,
        protected ResponseService $response,
    )
    {
    }

    public function complete(int $id): ?ResponseService
    {
        if (empty($this->childStatus($id))) {
            $this->response->setTaskCompleteData(
                $id, $this->setCompleteStatus($id)
            );
        } else {
            throw new ServiceException(__('task.complete_fail', ['id' => $id]),);
        }
        return $this->response;
    }

    protected function childStatus(int $id): array
    {
        return $this->task->getTaskChildStatus([$id, $id]);
    }

    protected function setCompleteStatus(int $id): int
    {
        $result = $this->task->complete($id);

        if (!$result) {
            throw new ServiceException(__('task.not_found', ['id' => $id]),);
        }
        return $result;
    }
}
