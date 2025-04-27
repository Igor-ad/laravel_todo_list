<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollectionResource;
use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: TaskCollectionResource::make($this->answer->answerData->toCollect()),
            status: $this->answer->answerData->getStatus(),
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
