<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskMarkedDoneController extends Controller
{

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

}
