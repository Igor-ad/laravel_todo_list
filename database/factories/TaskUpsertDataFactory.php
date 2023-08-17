<?php

namespace Database\Factories;

use App\Data\TaskUpsertData;

class TaskUpsertDataFactory
{
    /**
     * @param object $request
     * @param int|null $userId
     * @return TaskUpsertData
     */
    public function getValidData(object $request, ?int $userId): TaskUpsertData
    {
        return new TaskUpsertData(...$request->validated(), user_id: $userId);
    }
}
