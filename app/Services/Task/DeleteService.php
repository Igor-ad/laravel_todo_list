<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\ServiceException;
use App\Repositories\TaskRepository;
use App\Services\CommonService;
use App\Services\ResponseService;

class DeleteService extends CommonService
{
    public function __construct(
        protected TaskRepository  $task,
        protected ResponseService $response,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function delete(int $id): ResponseService
    {
        if ($this->task->hasStatusDone($id)) {
            throw new ServiceException(__('task.delete_fail', ['id' => $id]),);
        }
        $this->task->delete($id);

        return $this->response->setDeleteData($id);
    }
}
