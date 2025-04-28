<?php

declare(strict_types=1);

namespace App\Data\Request\Factories;

use App\Data\Request\RequestDataInterface;

interface RequestDataFactoryInterface
{
    public function getData(): RequestDataInterface;
}
