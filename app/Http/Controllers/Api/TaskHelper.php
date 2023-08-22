<?php

namespace App\Http\Controllers\Api;

use App\Data\AnswerData;
use Exception;
use Illuminate\Http\JsonResponse;
use Database\Factories\AnswerDataFactory;

trait TaskHelper
{
    protected AnswerData $aData;

    /**
     * @param Exception $e
     * @return void
     */
    protected function getCatch(Exception $e): void
    {
        $status = 500;
        $message = $e->getMessage();
        $code = $e->getCode();
        $this->aData = AnswerDataFactory::answerData([$status, $message, $code]);
    }

    /**
     * @return JsonResponse
     */
    protected function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: [$this->aData->getData()],
            status: $this->aData->status
        );
    }
}
