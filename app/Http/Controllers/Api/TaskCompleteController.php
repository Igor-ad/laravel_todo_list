<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnswerService;
use App\Services\Task\CompleteService;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskCompleteController extends Controller
{
    /**
     * @param CompleteService $completeService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected CompleteService $completeService,
        protected AnswerService   $answerService,
    )
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function complete(int $id): JsonResponse
    {
        try {
            $response = $this->completeService->complete($id);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

}
