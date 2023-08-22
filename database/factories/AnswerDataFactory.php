<?php

namespace Database\Factories;

use App\Data\AnswerData;

class AnswerDataFactory
{
    /**
     * @param array $data
     * @return AnswerData
     */
    public static function answerData(array $data): AnswerData
    {
        return new AnswerData(...$data);
    }
}
