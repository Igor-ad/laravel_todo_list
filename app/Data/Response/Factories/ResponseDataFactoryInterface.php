<?php

declare(strict_types=1);

namespace App\Data\Response\Factories;

use App\Data\Response\ResponseDataInterface;
use Illuminate\Support\Collection;

interface ResponseDataFactoryInterface
{
    public static function getDTO(Collection $collection): ResponseDataInterface;
}
