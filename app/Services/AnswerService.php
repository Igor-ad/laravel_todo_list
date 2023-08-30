<?php

namespace App\Services;

use App\Data\AnswerData;
use Database\Factories\AnswerDataFactory;

class AnswerService
{
    public AnswerData $answerData;

    /**
     * @param int $status
     * @param string $message
     * @param object|bool|null $data
     * @param string|int|null $code
     */
    public function setAnswerData(
        int              $status,
        string           $message,
        object|bool|null $data,
        string|int|null  $code
    ): void
    {
        $this->answerData = AnswerDataFactory::answerData([$status, $message, $data, $code]);
    }

    /**
     * @param ResponseService $responseService
     * @return void
     */
    public function setAnswer(ResponseService $responseService): void
    {
        $this->answerData = AnswerDataFactory::answerData(
            $responseService->responseData->getData()
        );
    }
}
