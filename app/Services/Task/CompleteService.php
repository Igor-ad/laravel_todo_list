<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\TaskServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;
use Exception;
use Illuminate\Support\Facades\DB;

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
            throw new TaskServiceException(
                message: __('task.complete_fail', ['id' => $id]),
            );
        }
        return $this->response;
    }

    protected function childStatus(int $id): array
    {
        return $this->task->getTaskChildStatus([$id, $id]);
    }

    protected function setCompleteStatus(int $id): int
    {
        DB::beginTransaction();
        try {
            $result = $this->task->complete($id);

            if (!$result) {
                throw new TaskServiceException(
                    message: __('task.not_found', ['id' => $id]),
                );
            }

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $result;
    }
}
