<?php

namespace App\Data\Request\Factories;

use App\Data\Request\TaskCreateData;
use App\Http\Requests\Api\TaskRequest;

class TaskCreateDataFactory implements RequestDataFactoryInterface
{
    public function __construct(
        protected TaskRequest $request,
    )
    {
    }

    public function getValidData(): TaskCreateData
    {
        return new TaskCreateData(...$this->request->validated());
    }
}
