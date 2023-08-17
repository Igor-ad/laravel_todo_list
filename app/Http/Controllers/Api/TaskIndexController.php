<?php

namespace App\Http\Controllers\Api;

use App\Data\AnswerData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskIndexRequest;
use App\Services\TaskIndexService;
use Database\Factories\TaskDataFactory;
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
        protected TaskDataFactory  $taskFactory,
        protected AnswerData       $ans,

    )
    {
    }

    /**
     * @param TaskIndexRequest $request
     * @return JsonResponse
     */
    public function index(TaskIndexRequest $request): JsonResponse
    {
            $validData = $this->taskFactory->getValidData($request);
        try {
            $this->ans->status = 200;
            $this->ans->data = $this->taskIndexService->index($validData);
            $this->ans->message = $this->ans->data->isEmpty()
                ? __('task.index_filter_fail')
                : __('task.index');
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
