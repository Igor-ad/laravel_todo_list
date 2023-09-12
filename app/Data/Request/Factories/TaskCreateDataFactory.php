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

    /**
     * @return TaskCreateData
     */
    public function getValidData(): TaskCreateData
    {
        return new TaskCreateData(...$this->request->validated());
    }
}
