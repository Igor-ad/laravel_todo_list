<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Repositories\TaskRepository;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use Exception;
use RuntimeException;

class DeleteService
{
    public function __construct(
        protected TaskRepository  $repository,
        protected ResponseService $response,
    )
    {
    }

      public function delete(int $id): ResponseService
    {
        DB::beginTransaction();
        try {
            $doneStatus = $this->repository->doneStatus($id);

            if ($doneStatus) {
                throw new RuntimeException(
                    message: __('task.delete_fail', ['id' => $id]),
                );
            }
            $result = $this->repository->delete($id);

            if (!$result) {
                throw new RuntimeException(
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
