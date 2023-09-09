<?php

namespace App\Services;

use App\Exceptions\ProcessingException;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskCompleteService
{

    /**
     * @param TaskRepository $repository
     * @param ResponseService $response
     */
    public function __construct(
        protected TaskRepository  $repository,
        protected ResponseService $response,
    )
    {
    }

    /**
     * @param int $id
     * @return ResponseService|null
     * @throws Exception
     */
    public function complete(int $id): ?ResponseService
    {
        if (empty($this->childStatus($id))) {
            $this->response->setTaskCompleteData(
                $id, $this->setCompleteStatus($id)
            );
        } else {
            throw new ProcessingException(
                message: __('task.market_done_fail', ['id' => $id]),
            );
        }
        return $this->response;
    }

    /**
     * @param int $id
     * @return array
     */
    protected function childStatus(int $id): array
    {
        return $this->repository->getTaskChildStatus([$id, $id]);
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    protected function setCompleteStatus(int $id): bool
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->complete($id);
            if (!$result) {
                throw new ProcessingException(
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
