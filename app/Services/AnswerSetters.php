<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

trait AnswerSetters
{
    public function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: new TaskResource($this->answerData->toCollect()),
            status: $this->answerData->getStatus(),
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
