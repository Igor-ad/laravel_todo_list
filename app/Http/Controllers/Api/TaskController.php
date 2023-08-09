<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TaskRequest;
use App\Http\Requests\Api\TaskUpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskController extends TaskHelper
{

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $this->ans->data = $this->taskService->show($id);
            $this->ans->status = 200;
            $this->ans->message = "Task ID: $id";
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans, $this->ans->status);
    }

    /**
     * @param TaskUpdateRequest $request
     * @return JsonResponse
     */
    public function update(TaskUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $this->ans->data = $this->taskService->update($data);
            $this->ans->status = 200;
            $this->ans->message = "Task was updated successfully.'";
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans, $this->ans->status);
    }

    /**
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function add(TaskRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $this->ans->data = $this->taskService->add($data);
            $this->ans->status = 201;
            $this->ans->message = "Task was created successfully.'";
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans, $this->ans->status);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function del(int $id): JsonResponse
    {
        try {
            $this->ans->data = $this->taskService->del($id);
            $this->ans->status = 201;
            if (is_object($this->ans->data)) {
                $this->ans->message = "Task ID: $id status: 'done'. Please select another task.";
            } else {
                $this->ans->message = "Task ID: $id was deleted successfully.";
            }
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans, $this->ans->status);
    }

}
