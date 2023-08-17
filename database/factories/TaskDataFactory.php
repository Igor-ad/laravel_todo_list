<?php

namespace Database\Factories;

use App\Data\TaskIndexData;
use App\Http\Requests\Api\TaskIndexRequest;

class TaskDataFactory
{
    /**
     * @param TaskIndexRequest $request
     * @return TaskIndexData
     */
    public function getValidData(TaskIndexRequest $request): TaskIndexData
    {
        return new TaskIndexData(...$request->validated());
    }
}
