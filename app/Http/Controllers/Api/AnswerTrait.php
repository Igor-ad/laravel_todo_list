<?php

namespace App\Http\Controllers\Api;

use App\Data\AnswerData;
use Database\Factories\AnswerDataFactory;

trait AnswerTrait
{
    protected AnswerData $aData;

    /**
     * @param array $data
     */
    public function setAData(array $data): void
    {
        $this->aData = AnswerDataFactory::answerData($data);
    }
}
