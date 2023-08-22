<?php

namespace App\Http\Controllers\Api;

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
     * @param TaskDataFactory $taskFactory
     */
    public function __construct(
        protected TaskIndexService $taskIndexService,
        protected TaskDataFactory  $taskFactory,

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
            $status = 200;
            $data = $this->taskIndexService->index($validData);
            $message = $data->isEmpty()
                ? __('task.index_filter_fail')
                : __('task.index');
            $this->setAData([$status, $message, $data]);
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
