<?php

namespace App\Http\Controllers\Api;

use App\Services\AnswerService;
use App\Services\Task\CreateService;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskCreateController
{
    public function __construct(
        protected CreateService $taskService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        try {
            $response = $this->taskService->create();

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }
}
