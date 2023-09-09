<?php

namespace App\Services;

use App\Data\Request\TaskCreateData;
use App\Data\Request\TaskUpdateData;
use App\Exceptions\ProcessingException;
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
     * @throws ProcessingException
     */
    public function show(int $id): ResponseService
    {
        $result = User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->first();
        if ($result) {
            $this->response->setTaskShowData($id, $result);
        } else {
            throw new ProcessingException(
                message: __('task.not_found', ['id' => $id]),
            );
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
                ->update($data->getData()->toArray());

            if (!$result) {
                throw new ProcessingException(
                    message: __('task.not_found', ['id' => $data->getId()]),
                );
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
            $result = Task::create(array_merge(
                ['user_id' => Auth::id()],
                $data->getData()->toArray()),
            );
            if ($result) {
                $this->response->setTaskCreateData($result);
            } else {
                throw new ProcessingException(
                  message: __('task.create_fail')
                );
            }
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
                throw new ProcessingException(
                    message: __('task.delete_fail', ['id' => $id]),
                );
            }
            $result = $this->repository->delete($id);

            if (!$result) {
                throw new ProcessingException(
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
