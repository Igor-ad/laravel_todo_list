<?php

namespace App\Services;

use App\Data\TaskCreateData;
use App\Data\TaskUpdateData;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
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
        $result = User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->first();
        if ($result) {
            $this->response->setTaskShowData($id, $result);
        } else {
            $this->response->setTaskShowFailData($id, $result);
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
            $result = User::find(Auth::id())->tasks()
                ->where('id', $data->getId())
                ->update($data->getData());

            if (!$result) {
                $this->response->setTaskUpdateFailData($data->getId());

                return $this->response;
            }
            $result = User::find(Auth::id())->tasks()
                ->where('id', $data->getId())
                ->first();

            $this->response->setTaskUpdateData($result);
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
     * @throws Exception
     */
    public function create(TaskCreateData $data): ResponseService
    {
        DB::beginTransaction();
        try {
            $result = Task::create($data->getData());

            $this->response->setTaskCreateData($result);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

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
            $result = $this->repository->delete($id);
            $this->response->setTaskDeleteData($id, $result);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }

}
