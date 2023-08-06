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
                'One or more children of Task ID: ' . $task->id
                . ' title: \'' . $task->title
                . '\' was`t change status to \'done\'', 200
            );
        } else {
            $this->markedDoneService->setTaskStatusDone($task);

            return response()->json(
                'Task ID: ' . $task->id
                . ' title: \'' . $task->title
                . '\' was marked done successfully', 200
            );
        }
    }

}
