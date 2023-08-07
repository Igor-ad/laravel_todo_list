<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;


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
        return response()->json($this->taskService->show($task), 200);
    }

    /**
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        $task = $this->taskService->update();

        return response()->json(
            sprintf('Task: %s was updated successfully', $task->title), 200
        );
    }

    /**
     * @return JsonResponse
     */
    public function add(): JsonResponse
    {
        $task = $this->taskService->add();


        return response()->json(
            sprintf('Task: title: %s - was created successfully.', $task->title), 201
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
                sprintf('Task ID: %d status:
                %s. Please select another task.', $task->id, $task->status), 200
            );
        }
        return response()->json(
            sprintf('Task ID: %d title:
            %s - was deleted successfully.', $task->id, $task->title), 200
        );
    }

}
