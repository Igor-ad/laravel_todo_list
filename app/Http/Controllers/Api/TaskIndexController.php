<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskIndexService;
use Illuminate\Http\JsonResponse;

class TaskIndexController extends Controller
{

    /**
     * @param TaskIndexService $taskService
     */
    public function __construct(
        protected TaskIndexService $taskService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getTasks();
        if ($tasks->isEmpty()) {
            return response()->json("Your repo dot'n have any tasks with this properties", 200);
        } else {
            return response()->json($tasks, 200);
        }
    }

}
