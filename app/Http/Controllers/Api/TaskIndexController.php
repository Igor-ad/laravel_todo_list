<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TaskOrderRequest;
use App\Http\Requests\Api\TaskIndexRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskIndexController extends TaskHelper
{

    /**
     * @param TaskIndexRequest $request
     * @param TaskOrderRequest $orderRequest
     * @return JsonResponse
     */
    public function index(TaskOrderRequest $orderRequest, TaskIndexRequest $request): JsonResponse
    {
        $order = empty($orderRequest->validated());
        $inputData = (object)$request->validated();

        try {
            $this->ans->status = 200;
            $this->ans->data = $this->taskIndexService->getTasks($inputData, $order);
            if ($this->ans->data->isEmpty()) {
                $this->ans->message = __('task.index_filter_fail');
            } else {
                $this->ans->message = __('task.index');
            }
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans, $this->ans->status);
    }

}
