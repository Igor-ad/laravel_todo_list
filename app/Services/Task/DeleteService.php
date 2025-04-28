<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\CommonService;

class DeleteService extends CommonService
{
    public function __construct(
        protected TaskRepository  $task,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function delete(int $id): int
    {
        if ($this->task->hasStatusDone($id)) {
            throw new ServiceException(__('task.delete_fail', ['id' => $id]),);
        }

        return $this->task->delete($id);
    }
}
