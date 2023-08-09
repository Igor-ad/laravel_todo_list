<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TaskFilterRequest;
use App\Http\Requests\Api\TaskIndexRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskIndexController extends TaskHelper
{

    /**
     * @param TaskIndexRequest $request
     * @param TaskFilterRequest $filterRequest
     * @return JsonResponse
     */
    public function index(TaskFilterRequest $filterRequest, TaskIndexRequest $request): JsonResponse
    {
        $filterData = $filterRequest->validated();
        $inputData = (object)$request->validated();

        try {
            $this->ans->data = $this->taskIndexService->getTasks($inputData, $filterData);
            $this->ans->status = 200;
            if ($this->ans->data->isEmpty()) {
                $this->ans->message = ("Your repo do not have any tasks with this properties");
            } else {
                $this->ans->message = ("All tasks");
            }
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans->data, $this->ans->status);
    }

}
