<?php

namespace Database\Factories;

use App\Data\TaskUpdateData;
use App\Http\Requests\Api\TaskUpdateRequest;

class TaskUpdateDataFactory
{
    /**
     * @param TaskUpdateRequest $request
     * @return TaskUpdateData
     */
    public function getValidData(TaskUpdateRequest $request): TaskUpdateData
    {
        return new TaskUpdateData(...$request->validated());
    }
}
