<?php

declare(strict_types=1);

namespace App\Data\Response\Factories;

use App\Data\Response\AnswerData;
use Illuminate\Support\Collection;

class AnswerDataFactory implements ResponseDataFactoryInterface
{
    public static function getDTO(array|Collection $collection): AnswerData
    {
        return new AnswerData(
            status: data_get($collection, 'status'),
            message: data_get($collection, 'message'),
            data: data_get($collection, 'data'),
            code: data_get($collection, 'code'),
        );
    }
}
