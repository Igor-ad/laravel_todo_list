<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Response\AnswerData;
use App\Data\Response\Factories\AnswerDataFactory;
use Illuminate\Support\Collection;

class AnswerService
{
    use AnswerSetters;

    public AnswerData $answerData;

    public function setAnswerData(Collection $data): void
    {
        $this->answerData = AnswerDataFactory::getDTO($data);
    }

    public function setAnswer(ResponseService $responseService): void
    {
        $this->setAnswerData($responseService->responseData->toCollect());
    }
}
