<?php

namespace Database\Factories;

use App\Data\TaskCreateData;
use App\Http\Requests\Api\TaskRequest;

class TaskCreateDataFactory
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
