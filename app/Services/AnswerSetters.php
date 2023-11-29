<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait AnswerSetters
{
    public function setExceptionAnswer(Exception $e): void
    {
        $this->setAnswerData($this->eFormatter($e));
    }

    protected function eFormatter(Exception $e): Collection
    {
        return collect([
            'status' => Response::HTTP_NOT_IMPLEMENTED,
            'message' => $e->getMessage(),
            'data' => null,
            'code' => $e->getCode(),
        ]);
    }

    public function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: $this->answerData->getData(),
            status: $this->answerData->getStatus(),
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
