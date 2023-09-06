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
    /**
     * @param TaskIndexService $indexService
     * @param TaskDataFactory $dataFactory
     */
    public function __construct(
        protected TaskIndexService $indexService,
        protected TaskDataFactory  $dataFactory,
    )
    {
        parent::__construct(answerService: $this->answerService);
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
