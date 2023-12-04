<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\JsonResponse;

trait AnswerSetters
{
    public function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: $this->answerData->getData(),
            status: $this->answerData->getStatus(),
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
