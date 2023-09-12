<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnswerService;
use App\Services\Task\UpdateService;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskUpdateController extends Controller
{
    /**
     * @param UpdateService $taskService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected UpdateService $taskService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        try {
            $response = $this->taskService->update();

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }
}
