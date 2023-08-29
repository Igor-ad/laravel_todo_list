<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\JsonResponse;

trait ControllerTrait
{
    /**
     * @param Exception $e
     * @return void
     */
    protected function getCatch(Exception $e): void
    {
        $this->answerService->setAnswerData(
            status: 500,
            message: $e->getMessage(),
            data: null,
            code: $e->getCode(),
        );
    }

    /**
     * @return JsonResponse
     */
    protected function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: $this->answerService->answerData->getData(),
            status: $this->answerService->answerData->getStatus(),
            headers: [],
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
