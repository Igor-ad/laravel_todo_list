<?php

namespace App\Services;

use App\Data\TaskUpsertData;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function __construct(
        protected TaskRepository $repository,
        protected TaskFilterService $filter,
    )
    {
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return Task::where($this->filter->getFilterParam($id))->first();
    }

    /**
     * @param TaskUpsertData $data
     * @return mixed
     * @throws Exception
     */
    public function update(TaskUpsertData $data): mixed
    {
        DB::beginTransaction();
        try {
            Task::where($this->filter->getFilterParam($data->id))
                ->firstOrFail()->update($data->getData());
            $result = Task::where($this->filter->getFilterParam($data->id))->first();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $result;
    }

    /**
     * @param TaskUpsertData $data
     * @return Task|null
     */
    public function create(TaskUpsertData $data): ?Task
    {
        return Task::create($data->getData());
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
            $status = $this->repository->doneStatus($id);
            if ($status) {
                return $status;
            }
            $status = $this->repository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $status;
    }

}
