<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

trait ControllerTrait
{
    /**
     * @param Exception $e
     * @return void
     */
    protected function getCatch(Exception $e): void
    {
        $this->answerService->setAnswerData($this->eFormatter($e));
    }

    protected function eFormatter(Exception $e): Collection
    {
        return collect([
            'status' => 500,
            'message' => $e->getMessage(),
            'data' => null,
            'code' => $e->getCode(),
        ]);
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
