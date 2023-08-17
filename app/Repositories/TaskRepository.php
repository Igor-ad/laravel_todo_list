<?php

namespace App\Repositories;

use App\Data\TaskIndexData;
use App\Data\TaskUpsertData;
use App\Models\Task;
use App\Services\TaskFilterService;
use App\Services\TaskOrderService;
use Illuminate\Database\Eloquent\Collection;
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
        return Task::where($this->filter->getFilter($data))
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getOrder(TaskIndexData $data): ?Collection
    {
        return Task::where($this->filter->getFilter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getAllFilter(TaskIndexData $data): ?Collection
    {
        return Task::where($this->filter->getFilter($data))
            ->whereRaw($this->filter->matchAgainstFilter($data))
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getOrderAllFilter(TaskIndexData $data): ?Collection
    {
        return Task::where($this->filter->getFilter($data))
            ->whereRaw($this->filter->matchAgainstFilter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    /**
     * @param TaskUpsertData $data
     * @return bool|null
     */
    public function updateTask(TaskUpsertData $data): ?bool
    {
        return Task::where($this->filter->getFilterParam($data->id))
            ->firstOrFail()
            ->update($data->getData());
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function doneStatusTask(int $id): ?Task
    {
        return Task::where($this->filter->getFilterParam($id))
            ->where('status', '=', 'done')
            ->first();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function eraseTask(int $id): bool
    {
        return Task::where($this->filter->getFilterParam($id))
            ->where('status', '=', 'todo')
            ->firstOrFail()
            ->delete();
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function taskMarkedDone(int $id): ?Task
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
