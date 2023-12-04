<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\TaskServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteService extends AbstractService
{
    public function __construct(
        protected TaskRepository  $task,
        protected ResponseService $response,
    )
    {
    }

      public function delete(int $id): ResponseService
    {
        DB::beginTransaction();
        try {
            $doneStatus = $this->task->doneStatus($id);

            if ($doneStatus) {
                throw new TaskServiceException(
                    message: __('task.delete_fail', ['id' => $id]),
                );
            }
            $result = $this->task->delete($id);

            if (!$result) {
                throw new TaskServiceException(
                    message: __('task.not_found', ['id' => $id])
                );
            }
            $this->response->setTaskDeleteData($id);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }
}
