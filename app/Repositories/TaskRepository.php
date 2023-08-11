<?php

namespace App\Repositories;

use App\Models\Task;
use App\Services\TaskFilterService;
use App\Services\TaskOrderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskRepository
{

    /**
     * @param TaskFilterService $filter
     * @param TaskOrderService $order
     */
    public function __construct(
        protected TaskFilterService $filter,
        protected TaskOrderService  $order,
    )
    {
    }

    /**
     * @param object $data
     * @return Collection
     */
    public function getUserTasks(object $data): Collection
    {
        return Task::where($this->filter->getFilter($data))
            ->get();
    }

    /**
     * @param object $data
     * @return Collection
     */
    public function getOrderUserTasks(object $data): Collection
    {
        return Task::where($this->filter->getFilter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    /**
     * @param object $data
     * @return Collection
     */
    public function getAllFilterUserTasks(object $data): Collection
    {
        return Task::where($this->filter->getFilter($data))
            ->whereRaw($this->filter->matchAgainstFilter($data))
            ->get();
    }

    /**
     * @param object $data
     * @return Collection
     */
    public function getOrderAllFilterUserTasks(object $data): Collection
    {
        return Task::where($this->filter->getFilter($data))
            ->whereRaw($this->filter->matchAgainstFilter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getTask(int $id): mixed
    {
        return Task::where($this->filter->getFilterParam($id))
            ->first();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function updateTask(array $data): mixed
    {
        return Task::where($this->filter->getFilterParam($data['id']))
            ->firstOrFail()
            ->update($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function storeTask(array $data): mixed
    {
        $data['user_id'] = Auth::id();

        return Task::create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function doneStatusTask(int $id): mixed
    {
        return Task::where($this->filter->getFilterParam($id))
            ->where('status', '=', 'done')
            ->first();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function eraseTask(int $id): mixed
    {
        return Task::where($this->filter->getFilterParam($id))
            ->where('status', '=', 'todo')
            ->firstOrFail()
            ->delete();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function taskMarkedDone(int $id): mixed
    {
        return Task::where($this->filter->getFilterParam($id))
            ->firstOrFail()
            ->update([
                'status' => 'done',
                'completed_at' => now(),
            ]);
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
