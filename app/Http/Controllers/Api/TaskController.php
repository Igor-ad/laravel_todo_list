<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{

    /**
     * @param Request $request
     */
    public function __construct(protected Request $request)
    {
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = $this->getTasks();

        return response()->json($tasks, 200);
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
     * @return array
     */
    private function filter(): array
    {
        $userId = Auth::id();
        $where['user_id'] = " $userId";

        if ($this->request->has('status')) {
            $value = $this->request->input('status');
            $where[] = ['status', $value];
        }

        if ($this->request->has('priority')) {
            $value = $this->request->input('priority');
            $where[] = ['priority', '>=', $value];
        }
        return $where;
    }

    /**
     * @return array|null
     */
    private function orderDirection(): ?array
    {
        switch (true) {
            case $this->request->has('createdSort'):
                $orderDirection[] = 'created_at ' . $this->request->input('createdSort');

            case $this->request->has('completedSort'):
                $orderDirection[] = 'completed_at ' . $this->request->input('completedSort');

            case $this->request->has('prioritySort'):
                $orderDirection[] = 'priority ' . $this->request->input('prioritySort');
                break;

            default:
                $orderDirection = null;
        }
        return $orderDirection;
    }

    /**
     * @return mixed
     */
    private function getTasks(): mixed
    {
        $orderDirection = $this->orderDirection();

        if (is_null($orderDirection)) {
            if ($this->request->has('title')) {
                $value = $this->request->input('title');
                $tasks = Task::where($this->filter())
                    ->whereRaw("MATCH (`title`) AGAINST ($value)")
                    ->get();
            } else {
                $tasks = Task::where($this->filter())
                    ->get();
            }
        } else {
            if ($this->request->has('title')) {
                $value = $this->request->has('title');
                $tasks = Task::where($this->filter())
                    ->whereRaw("MATCH (`title`) AGAINST ($value)")
                    ->orderByRaw(implode(' ,', $orderDirection))
                    ->get();
            } else {
                $tasks = Task::where($this->filter())
                    ->orderByRaw(implode(' ,', $orderDirection))
                    ->get();
            }
        }
        return $tasks;
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
     * @param int $id
     * @return int
     */
    protected function hasTaskChildTodo(int $id): int
    {
        $sql = "
            WITH RECURSIVE t2 AS
            (
                SELECT `id`,`status`
                FROM tasks WHERE id = $id
                UNION ALL
                SELECT t.`id`, t.`status`
                FROM tasks t
                JOIN t2 ON t2.`id` = t.`parent_id`
            )
            SELECT SUM( IF ( `status` = 'todo', 1, 0 ) ) AS 'cStatus' FROM t2;
        ";
        return DB::select($sql)[0]->cStatus;
    }

    /**
     * @param Task $task
     * @return JsonResponse
     */
    public function done(Task $task): JsonResponse
    {
        if ($this->hasTaskChildTodo($task->id) > 1) {
            return response()->json(
                'One or more children of Task ID: ' . $task->id
                . ' title: \'' . $task->title
                . '\' was`t done', 200
            );
        } else {
            Task::where([
                ['user_id', '=', Auth::id()],
                ['id', '=', $task->id],
            ])
                ->firstOrFail()
                ->update(
                    ['status' => 'done'],
                );

            return response()->json(
                'Task ID: ' . $task->id
                . ' title: \'' . $task->title
                . '\' was marked done successfully', 200
            );
        }
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
