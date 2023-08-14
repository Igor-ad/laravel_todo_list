<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function __construct(
        protected TaskRepository $repository,
    )
    {
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return $this->repository->getTask($id);
    }

    /**
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function update(array $data): mixed
    {
        DB::beginTransaction();
        try {
            $this->repository->updateTask($data);
            $result = $this->repository->getTask($data['id']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $result;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->repository->storeTask($data);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function delete(int $id): mixed
    {
        DB::beginTransaction();
        try {
            $status = $this->repository->doneStatusTask($id);
            if ($status) {
                return $status;
            }
            $status = $this->repository->eraseTask($id);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $status;
    }

}
