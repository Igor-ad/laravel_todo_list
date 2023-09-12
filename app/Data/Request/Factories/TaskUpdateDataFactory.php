<?php

namespace App\Data\Request\Factories;

use App\Data\Request\TaskUpdateData;
use App\Http\Requests\Api\TaskUpdateRequest;

class TaskUpdateDataFactory implements RequestDataFactoryInterface
{
    public function __construct(
        protected TaskUpdateRequest $request,
    )
    {
    }

    /**
     * @return TaskUpdateData
     */
    public function getValidData(): TaskUpdateData
    {
        return new TaskUpdateData(...$this->request->validated());
    }
}
