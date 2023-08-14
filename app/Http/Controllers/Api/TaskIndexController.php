<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskOrderRequest;
use App\Http\Requests\Api\TaskIndexRequest;
use App\Services\TaskIndexService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskIndexController extends Controller
{
    use TaskHelper;

    /**
     * @param TaskIndexService $taskIndexService
     * @param object $ans
     */
    public function __construct(
        protected TaskIndexService $taskIndexService,
        protected object           $ans = new \stdClass,
    )
    {
    }

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
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
