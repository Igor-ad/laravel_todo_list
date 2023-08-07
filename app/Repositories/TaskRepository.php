<?php

namespace App\Repositories;

use App\Http\Requests\Api\TaskRequest;
use App\Models\Task;
use App\Http\Requests\Api\TaskIndexRequest;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{


    /**
     * @param TaskIndexRequest $request
     * @param TaskRequest $addRequest
     */
    public function __construct(
        protected TaskIndexRequest $request,
        protected TaskRequest      $addRequest,
    )
    {
    }

    /**
     * @param Task $task
     * @return mixed
     */
    public function showTask(Task $task): mixed
    {
        return $task;
    }

    /**
     * @return mixed
     */
    public function getTask(): mixed
    {
        return Task::where([
            ['user_id', '=', Auth::id()],
            ['id', '=', $this->request->all('id')],
        ])
            ->first();
    }

    /**
     * @return mixed
     */
    public function updateTask(): mixed
    {
        return Task::where([
            ['user_id', '=', Auth::id()],
            ['id', '=', $this->request->all('id')],
        ])
            ->firstOrFail()
            ->update($this->request->all());
    }

    /**
     * @return mixed
     */
    public function storeTask(): mixed
    {
        $this->addRequest['user_id'] = Auth::id();
        return Task::create($this->addRequest->all());
    }

    /**
     * @param Task $task
     * @return mixed
     */
    public function doneStatusTask(Task $task): mixed
    {
        return Task::where([
            ['id', '=', $task->id],
            ['user_id', '=', Auth::id()],
            ['status', '=', 'done'],
        ])
            ->first();
    }

    /**
     * @param Task $task
     * @return mixed
     */
    public function eraseTask(Task $task): mixed
    {
        return Task::where([
            ['id', '=', $task->id],
            ['user_id', '=', Auth::id()],
            ['status', '=', 'todo'],
        ])
            ->findOrFail($task->id)
            ->delete();
    }
}
