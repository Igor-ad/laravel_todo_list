<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskIndexRequest;
use App\Services\AnswerService;
use App\Services\TaskIndexService;
use Database\Factories\TaskDataFactory;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskIndexController extends Controller
{
    /**
     * @param TaskIndexService $taskIndexService
     * @param TaskDataFactory $taskFactory
     * @param AnswerService $answerService
     */
    public function __construct(
        protected TaskIndexService $taskIndexService,
        protected TaskDataFactory  $taskFactory,
        protected AnswerService    $answerService,
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
            $response = $this->taskIndexService->index($validData);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

}
