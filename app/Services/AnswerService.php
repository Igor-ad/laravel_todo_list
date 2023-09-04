<?php

namespace App\Services;

use App\Data\AnswerData;
use Database\Factories\AnswerDataFactory;
use Illuminate\Support\Collection;

class AnswerService
{
    use AnswerSetters;

    public AnswerData $answerData;

    /**
     * @param Collection $data
     * @return void
     */
    public function setAnswerData(Collection $data): void
    {
        $this->answerData = AnswerDataFactory::answerData($data);
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
