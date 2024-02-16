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
    )
    {
    }

    public function delete(int $id): ResponseService
    {
        $doneStatus = $this->task->doneStatus($id);

        if ($doneStatus) {
            throw new ServiceException(__('task.delete_fail', ['id' => $id]),);
        }

        $result = $this->task->delete($id);

        if (!$result) {
            throw new ServiceException(__('task.not_found', ['id' => $id]));
        }

        $this->response->setDeleteData($id);

        return $this->response;
    }
}
