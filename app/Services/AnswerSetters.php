<?php

namespace App\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

trait AnswerSetters
{
    /**
     * @param Exception $e
     * @return void
     */
    public function setExceptionAnswer(Exception $e): void
    {
        $this->setAnswerData($this->eFormatter($e));
    }

    /**
     * @param Exception $e
     * @return Collection
     */
    protected function eFormatter(Exception $e): Collection
    {
        return collect([
            'status' => Response::HTTP_NOT_IMPLEMENTED,
            'message' => $e->getMessage(),
            'data' => null,
            'code' => $e->getCode(),
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: $this->answerData->getData(),
            status: $this->answerData->getStatus(),
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
