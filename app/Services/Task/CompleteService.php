<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\ServiceException;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\CommonService;

class CompleteService extends CommonService
{
    public function __construct(
        protected TaskRepository  $task,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function complete(int $id): int
    {
        if ($this->hasChildrenStatusTodo($id)) {
            throw new ServiceException(__('task.complete_fail', ['id' => $id]));
        }
        return $this->task->complete($id);
    }

    protected function hasChildrenStatusTodo(int $id): bool
    {
        return (bool)$this->checkChildrenStatus($id)->getAttribute('children_count');
    }

    public function checkChildrenStatus(int $id): Task
    {
        return $this->task->hasChildrenStatusTodo($id);
    }
}
