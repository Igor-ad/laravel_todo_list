<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{

    /**
     * @param TaskService $taskService
     */
    public function __construct(
        protected TaskService $taskService,
    )
    {
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function show(Task $task): JsonResponse
    {
        if ($task->user_id === Auth::id()) {
            return response()->json($this->taskService->show($task), 200);
        } else {
            return response()->json('You don`t have enough permissions!', 200);
        }
    }

    /**
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        $task = $this->taskService->update();

        return response()->json(
            'Task: ' . $task->title
            . ' was updated successfully', 200
        );
    }

    /**
     * @return JsonResponse
     */
    public function add(): JsonResponse
    {
        $task = $this->taskService->add();

        return response()->json(
            'Task: \'' . $task->title
            . '\' was created successfully', 201
        );
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function del(Task $task): JsonResponse
    {
        if (is_object($this->taskService->del($task))) {
            return response()->json(
                'Task ID: ' . $task->id
                . ' status: ' . $task->status
                . '. Please select another task.', 200
            );
        } else {
            return response()->json(
                'Task ID: ' . $task->id
                . ', title: \'' . $task->title
                . '\' - was deleted successfully', 200
            );
        }
    }

}
