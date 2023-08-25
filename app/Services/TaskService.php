<?php

namespace App\Services;

use App\Data\TaskCreateData;
use App\Data\TaskUpdateData;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function __construct(
        protected TaskRepository    $repository,
        protected TaskFilterService $filter,
        protected ResponseService   $response,
    )
    {
    }

    /**
     * @param int $id
     * @return ResponseService
     */
    public function show(int $id): ResponseService
    {
        $data = Task::where($this->filter->getFilterParam($id))->first();
        if ($data) {
            $this->response->setTaskShowData($id, $data);
        } else {
            $this->response->setTaskShowFailData($id, $data);
        }
        return $this->response;
    }

    /**
     * @param TaskUpdateData $data
     * @return ResponseService
     * @throws Exception
     */
    public function update(TaskUpdateData $data): ResponseService
    {
        DB::beginTransaction();
        try {
            Task::where($this->filter->getFilterParam($data->id))
                ->firstOrFail()->update($data->getData());

            $data = Task::where($this->filter->getFilterParam($data->id))->first();

            $this->response->setTaskUpdateData($data);

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }

    /**
     * @param TaskCreateData $data
     * @return ResponseService
     */
    public function create(TaskCreateData $data): ResponseService
    {
        $data = Task::create($data->getData());

        $this->response->setTaskCreateData($data);

        return $this->response;
    }

    /**
     * @param int $id
     * @return ResponseService
     * @throws Exception
     */
    public function delete(int $id): ResponseService
    {
        DB::beginTransaction();
        try {
            $doneStatus = $this->repository->doneStatus($id);

            if ($doneStatus) {
                $this->response->setTaskDeleteFailData($id, $doneStatus);

                return $this->response;
            }
            $data = $this->repository->delete($id);
            $this->response->setTaskDeleteData($id, $data);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }

}
