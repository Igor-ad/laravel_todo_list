<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TaskIndexRequest;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TaskIndexController extends Controller
{

    /**
     * @param TaskIndexRequest $request
     */
    public function __construct(protected TaskIndexRequest $request)
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
                    ->whereRaw("MATCH (`title`) AGAINST ('$value')")
                    ->get();
            } else {
                $tasks = Task::where($this->filter())
                    ->get();
            }
        } else {
            if ($this->request->has('title')) {
                $value = $this->request->has('title');
                $tasks = Task::where($this->filter())
                    ->whereRaw("MATCH (`title`) AGAINST ('$value')")
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

}
