<?php

namespace App\Repositories;

use App\Data\TaskIndexData;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;
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
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function get(TaskIndexData $data): ?Collection
    {
        return $data->hasFilter()
            ? User::find(Auth::id())->tasks()
                ->where($this->filter->getFilter($data))
                ->get()
            : User::find(Auth::id())->tasks()->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getOrder(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->getFilter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getAllFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->getFilter($data))
            ->whereRaw($this->filter->fullTextFilter($data))
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getOrderAllFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->getFilter($data))
            ->whereRaw($this->filter->fullTextFilter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function doneStatus(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->where('status', TaskStatusEnum::DONE->value)
            ->first();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return User::find(Auth::id())->tasks()
            ->findOrFail($id)
            ->delete();
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function complete(int $id): ?bool
    {
        return User::find(Auth::id())->tasks()
            ->findOrFail($id)
            ->update([
                'status' => TaskStatusEnum::DONE->value,
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
