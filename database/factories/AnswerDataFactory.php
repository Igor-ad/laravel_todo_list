<?php

namespace Database\Factories;

use App\Data\AnswerData;
use Illuminate\Support\Collection;

class AnswerDataFactory
{
    /**
     * @param Collection $data
     * @return AnswerData
     */
    public static function answerData(Collection $data): AnswerData
    {
        return new AnswerData(...$data);
    }
}
