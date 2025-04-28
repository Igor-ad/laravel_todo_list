<?php

declare(strict_types=1);

namespace App\Data\Request\Factories\Task;

use App\Data\Request\Factories\RequestDataFactoryInterface;
use App\Data\Request\RequestDataInterface;

abstract class AbstractDataFactory implements RequestDataFactoryInterface
{
    protected RequestDataInterface $requestData;

    abstract protected function getValidData(array $data): RequestDataInterface;

    public function __construct(array $data)
    {
        $this->requestData = $this->getValidData($data);
    }

    public function getData(): RequestDataInterface
    {
        return $this->requestData;
    }
}
