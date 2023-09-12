<?php

namespace App\Data\Request\Factories;

use App\Data\Request\RequestDataInterface;

interface RequestDataFactoryInterface
{
    /**
     * @return RequestDataInterface
     */
    public function getValidData(): RequestDataInterface;
}
