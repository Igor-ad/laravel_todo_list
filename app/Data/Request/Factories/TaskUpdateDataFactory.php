<?php

namespace App\Data\Request\Factories;

use App\Data\Request\TaskUpdateData;
use App\Http\Requests\Api\ApiRequestInterface;
use App\Http\Requests\Api\TaskUpdateRequest;

class TaskUpdateDataFactory implements ApiRequestInterface
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
