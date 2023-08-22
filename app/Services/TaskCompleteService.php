<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskCompleteService
{

    /**
     * @param TaskRepository $repository
     */
    public function __construct(
        protected TaskRepository $repository,
    )
    {
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
    public function decisionChildTodo(int $id): bool
    {
        $status = empty($this->childStatus($id));
        if ($status) {
            $this->setCompleteStatus($id);
        }
        return $status;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    protected function setCompleteStatus(int $id): mixed
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->complete($id);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $result;
    }
}
