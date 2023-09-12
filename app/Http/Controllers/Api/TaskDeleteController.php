<?php

namespace App\Http\Controllers\Api;

use App\Services\AnswerService;
use App\Services\Task\DeleteService;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskDeleteController
{
    /**
     * @param DeleteService $deleteService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected DeleteService $deleteService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public
    function delete(int $id): JsonResponse
    {
        try {
            $response = $this->deleteService->delete($id);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }
}
