<?php

namespace App\Data\Request\Factories;

use App\Data\Request\TaskUpdateData;
use App\Http\Requests\Api\ApiRequestInterface;
use App\Http\Requests\Api\TaskUpdateRequest;

class TaskUpdateDataFactory implements RequestDataFactoryInterface
{
    /**
     * @param TaskUpdateRequest|ApiRequestInterface $request
     * @return TaskUpdateData
     */
    public function getValidData(TaskUpdateRequest|ApiRequestInterface $request): TaskUpdateData
    {
        return new TaskUpdateData(...$request->validated());
    }
}
