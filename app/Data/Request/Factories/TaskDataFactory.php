<?php

namespace App\Data\Request\Factories;

use App\Data\Request\TaskIndexData;
use App\Http\Requests\Api\ApiRequestInterface;
use App\Http\Requests\Api\TaskIndexRequest;

class TaskDataFactory implements RequestDataFactoryInterface
{
    /**
     * @param TaskIndexRequest|ApiRequestInterface $request
     * @return TaskIndexData
     */
    public function getValidData(TaskIndexRequest|\App\Http\Requests\Api\ApiRequestInterface $request): TaskIndexData
    {
        return new TaskIndexData(...$request->validated());
    }
}
