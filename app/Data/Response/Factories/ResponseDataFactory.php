<?php

declare(strict_types=1);

namespace App\Data\Response\Factories;

use App\Data\Response\ResponseData;
use Illuminate\Support\Collection;

class ResponseDataFactory implements ResponseDataFactoryInterface
{
    public static function getDTO(array|Collection $collection): ResponseData
    {
        return new ResponseData(
            status: data_get($collection, 'status'),
            message: data_get($collection, 'message', ''),
            data: data_get($collection, 'data'),
        );
    }
}
