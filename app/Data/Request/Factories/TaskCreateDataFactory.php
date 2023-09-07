<?php

namespace App\Data\Request\Factories;

use App\Data\Request\TaskCreateData;
use App\Http\Requests\Api\ApiRequestInterface;
use App\Http\Requests\Api\TaskRequest;

class TaskCreateDataFactory implements ApiRequestInterface
{
    /**
     * @param TaskRequest $request
     * @param int $userId
     * @return TaskCreateData
     */
    public function getValidData(int $userId, TaskRequest $request): TaskCreateData
    {
        return new TaskCreateData($userId, ...$request->validated());
    }
}
