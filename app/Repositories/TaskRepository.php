<?php

namespace App\Repositories;

use App\Data\Request\TaskCreateData;
use App\Data\Request\TaskIndexData;
use App\Data\Request\TaskUpdateData;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;
use App\Services\Task\FilterService;
use App\Services\Task\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskRepository
{

    /**
     * @param FilterService $filterService
     * @param OrderService $orderService
     */
    public function __construct(
        protected FilterService $filterService,
        protected OrderService  $orderService,
    )
    {
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function getById(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->first();
    }

    /**
     * @return Collection|null
     */
    public function getTask(): ?Collection
    {
        return User::find(Auth::id())->tasks()->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getByFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filterService->filter($data))
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function get(TaskIndexData $data): ?Collection
    {
        return $data->hasFilter()
            ? $this->getByFilter($data)
            : $this->getTask();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getOrder(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filterService->filter($data))
            ->orderByRaw($this->orderService->orderExpression($data))
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getAllFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filterService->filter($data))
            ->whereRaw($this->filterService->fullTextFilter(), [$data->getTitle()])
            ->get();
    }

    /**
     * @param TaskIndexData $data
     * @return Collection|null
     */
    public function getOrderAllFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filterService->filter($data))
            ->whereRaw($this->filterService->fullTextFilter(), [$data->getTitle()])
            ->orderByRaw($this->orderService->orderExpression($data))
            ->get();
    }

    /**
     * @param TaskUpdateData $data
     * @return bool|null
     */
    public function updateById(TaskUpdateData $data): ?bool
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $data->getId())
            ->update($data->getData()->toArray());
    }

    /**
     * @param TaskCreateData $data
     * @return Task|null
     */
    public function create(TaskCreateData $data): ?Task
    {
        return Task::create(array_merge(
            ['user_id' => Auth::id()],
            $data->getData()->toArray()),
        );
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
            ->where('id', $id)
            ->delete();
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function complete(int $id): ?bool
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $id)
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
