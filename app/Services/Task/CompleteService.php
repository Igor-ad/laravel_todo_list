<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Repositories\TaskRepository;
use App\Services\ResponseService;
use Exception;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CompleteService
{
    public function __construct(
        protected TaskRepository  $repository,
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
            throw new RuntimeException(
                message: __('task.complete_fail', ['id' => $id]),
            );
        }
        return $this->response;
    }

    protected function childStatus(int $id): array
    {
        return $this->repository->getTaskChildStatus([$id, $id]);
    }

    protected function setCompleteStatus(int $id): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->complete($id);

            if (!$result) {
                throw new RuntimeException(
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
