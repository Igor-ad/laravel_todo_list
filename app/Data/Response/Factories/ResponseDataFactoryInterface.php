<?php

namespace App\Data\Response\Factories;

use App\Data\Response\ResponseDataInterface;
use Illuminate\Support\Collection;

interface ResponseDataFactoryInterface
{
    /**
     * @param Collection $collection
     * @return ResponseDataInterface
     */
    public static function getDTO(Collection $collection): ResponseDataInterface;
}
