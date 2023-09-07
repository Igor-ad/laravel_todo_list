<?php

namespace App\Data\Response\Factories;

use App\Data\Response\AnswerData;
use Illuminate\Support\Collection;

class AnswerDataFactory implements ResponseDataFactoryInterface
{
    /**
     * @param Collection $collection
     * @return AnswerData
     */
    public static function getDTO(Collection $collection): AnswerData
    {
        return new AnswerData(...$collection);
    }
}
