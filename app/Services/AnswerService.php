<?php

namespace App\Services;

use App\Data\Response\AnswerData;
use App\Data\Response\Factories\AnswerDataFactory;
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
        $this->answerData = AnswerDataFactory::getDTO($data);
    }

    /**
     * @param ResponseService $responseService
     * @return void
     */
    public function setAnswer(ResponseService $responseService): void
    {
        $this->answerData = AnswerDataFactory::getDTO(
            $responseService->responseData->getData()
        );
    }
}
