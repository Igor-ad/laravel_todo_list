<?php

declare(strict_types=1);

namespace App\Data\Request\Factories\Task;

use App\Data\Request\Factories\RequestDataFactoryInterface;
use App\Data\Request\TaskDTO\CreateData;
use App\Http\Requests\Task\CreateRequest;

class CreateDataFactory implements RequestDataFactoryInterface
{
    public function __construct(
        protected CreateRequest $request,
    )
    {
    }

    public function getValidData(): CreateData
    {
        return CreateData::fromArray($this->request->validated());
    }
}
