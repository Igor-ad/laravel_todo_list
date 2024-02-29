<?php

declare(strict_types=1);

namespace App\Data\Response\Factories;

use App\Data\Response\ResponseData;
use Illuminate\Support\Collection;

class ResponseDataFactory implements ResponseDataFactoryInterface
{
    public static function getDTO(Collection $collection): ResponseData
    {
        return ResponseData::fromCollect($collection);
    }
}
