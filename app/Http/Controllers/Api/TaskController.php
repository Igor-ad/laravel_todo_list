<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\TaskRequest;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{

    /**
     * @param TaskRequest $request
     */
    public function __construct(protected TaskRequest $request)
    {
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function show(Task $task): JsonResponse
    {
        if ($task->user_id === Auth::id()) {
            return response()->json($task, 200);
        } else {
            return response()->json('You don`t have enough permissions!', 200);
        }
    }

    /**
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        $task = Task::where([
            ['user_id', '=', Auth::id()],
            ['id', '=', $this->request->all('id')],
        ])
            ->firstOrFail()
            ->update($this->request->all());

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
        $this->request['user_id'] = Auth::id();
        $task = Task::create($this->request->all());

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
        Task::where([
            ['id', '=', $task->id],
            ['user_id', '=', Auth::id()],
            ['status', '=', 'todo'],
        ])
            ->findOrFail($task->id)
            ->delete();

        return response()->json(
            'Task ID: ' . $task->id
            . ', title: \'' . $task->title
            . '\' - was deleted successfully', 200
        );
    }

}
