<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Services\TaskMarkedDoneService;
use Illuminate\Http\JsonResponse;

class TaskMarkedDoneController extends Controller
{
    public function __construct(protected TaskMarkedDoneService $markedDoneService)
    {
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function done(Task $task): JsonResponse
    {
        if ($this->markedDoneService->decisionChildTodo($task)) {

            return response()->json(
                sprintf("One or more children of Task ID: %d title:
                 '%s' was't change status to 'done'", $task->id, $task->title), 200
            );
        }

        $this->markedDoneService->setTaskStatusDone($task);

        return response()->json(
            sprintf("Task ID: %d title:
                '%s' was marked 'done' successfully", $task->id, $task->title), 200
        );
    }

}
