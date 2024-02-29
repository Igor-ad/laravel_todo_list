<?php

declare(strict_types=1);

namespace App\Data\Response\Factories;

use App\Data\Response\AnswerData;
use Illuminate\Support\Collection;

class AnswerDataFactory implements ResponseDataFactoryInterface
{
    public static function getDTO(Collection $collection): AnswerData
    {
        return AnswerData::fromCollect($collection);
    }
}
