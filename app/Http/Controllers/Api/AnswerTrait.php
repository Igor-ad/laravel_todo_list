<?php

namespace App\Http\Controllers\Api;

use App\Data\AnswerData;
use App\Services\ResponseService;
use Database\Factories\AnswerDataFactory;

trait AnswerTrait
{
    protected AnswerData $answerData;

    /**
     * @param int $status
     * @param string $message
     * @param object|bool|null $data
     * @param string|int|null $code
     */
    protected function setAnswerData(
        int              $status,
        string           $message,
        object|bool|null $data,
        string|int|null  $code
    ): void
    {
        $this->answerData = AnswerDataFactory::answerData(
            status: $status,
            message: $message,
            data: $data,
            code: $code,
        );
    }

    /**
     * @param ResponseService $responseService
     * @return void
     */
    protected function setAnswer(ResponseService $responseService): void
    {
        $this->setAnswerData(
            status: $responseService->responseData->status,
            message: $responseService->responseData->message,
            data: $responseService->responseData->data,
            code: null,
        );
    }

}
