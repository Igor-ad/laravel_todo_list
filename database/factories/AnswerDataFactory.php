<?php

namespace Database\Factories;

use App\Data\AnswerData;

class AnswerDataFactory
{
    /**
     * @param int $status
     * @param string $message
     * @param bool|object|array|null $data
     * @param int|string|null $code
     * @return AnswerData
     */
    public static function answerData(
        int                    $status,
        string                 $message,
        bool|object|array|null $data,
        int|string|null        $code
    ): AnswerData
    {
        return new AnswerData(
            status: $status,
            message: $message,
            data: $data,
            code: $code
        );
    }
}
