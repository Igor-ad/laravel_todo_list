<?php

namespace App\Data\Response\Factories;

use App\Data\Response\ResponseData;
use Illuminate\Support\Collection;

class ResponseDataFactory implements ResponseDataFactoryInterface
{
    /**
     * @param Collection $collection
     * @return ResponseData
     */
    public static function getDTO(Collection $collection): ResponseData
    {
        return new ResponseData(...$collection);
    }
}
