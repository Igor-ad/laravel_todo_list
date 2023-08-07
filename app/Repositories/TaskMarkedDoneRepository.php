<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskMarkedDoneRepository
{
    /**
     * @param Task $task
     * @return void
     */
    public function taskMarkedDone(Task $task): void
    {
        Task::where([
            ['user_id', '=', Auth::id()],
            ['id', '=', $task->id],
        ])
            ->firstOrFail()
            ->update(
                ['status' => 'done'],
            );
    }

    /**
     * @param array $parentId
     * @return array
     */
    public function getTaskChildStatus(array $parentId): array
    {
        $sql = "
            WITH RECURSIVE t2 AS
            (
                SELECT `id`,`status`
                FROM tasks WHERE id = ?
                UNION ALL
                SELECT t.`id`, t.`status`
                FROM tasks t
                JOIN t2 ON t2.`id` = t.`parent_id`
            )
            SELECT * FROM t2 WHERE t2.id != ?;
        ";
        return DB::select($sql, $parentId);
    }

}
