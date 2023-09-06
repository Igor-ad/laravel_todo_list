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
     * @param TaskIndexService $indexService
     * @param TaskDataFactory $dataFactory
     * @param AnswerService $answerService
     */
    public function __construct(
        protected TaskIndexService $indexService,
        protected TaskDataFactory  $dataFactory,
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
        $validData = $this->dataFactory->getValidData($request);

        try {
            $response = $this->indexService->index($validData);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

}
