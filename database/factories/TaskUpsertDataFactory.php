<?php

namespace Database\Factories;

use App\Data\TaskUpsertData;

class TaskUpsertDataFactory
{
    /**
     * @param object $request
     * @return TaskUpsertData
     */
    public function getValidData(object $request): TaskUpsertData
    {
        return new TaskUpsertData($request->validated());
    }
}
