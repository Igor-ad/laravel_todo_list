<?php

namespace App\Data\Request\Factories;

use App\Data\Request\TaskCreateData;
use App\Http\Requests\Api\ApiRequestInterface;
use App\Http\Requests\Api\TaskRequest;

class TaskCreateDataFactory implements RequestDataFactoryInterface
{
    /**
     * @param TaskRequest|ApiRequestInterface $request
     * @return TaskCreateData
     */
    public function getValidData(TaskRequest|ApiRequestInterface $request): TaskCreateData
    {
        return new TaskCreateData(...$request->validated());
    }
}
