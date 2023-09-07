<?php

namespace App\Data\Request\Factories;

use App\Data\Request\RequestDataInterface;
use App\Http\Requests\Api\ApiRequestInterface;

interface RequestDataFactoryInterface
{
    /**
     * @param ApiRequestInterface $request
     * @return RequestDataInterface
     */
    public function getValidData(ApiRequestInterface $request): RequestDataInterface;
}
