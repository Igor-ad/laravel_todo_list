<?php

declare(strict_types=1);

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
    public function __construct(
        protected FilterService $filter,
        protected OrderService  $order,
    )
    {
    }

    public function getById(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->first();
    }


    public function getByIdWithBranches(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()->with(['branches'])
            ->where('id', $id)
            ->first();
    }

    public function getByIdWithChildren(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()->with(['children'])
            ->where('id', $id)
            ->first();
    }

    public function getByIdWithParent(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()->with(['parent'])
            ->where('id', $id)
            ->first();
    }

    public function getByIdWithParents(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()->with(['parents'])
            ->where('id', $id)
            ->first();
    }

    public function getTask(): ?Collection
    {
        return User::find(Auth::id())->tasks()->get();
    }

    public function getByFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->get();
    }

    public function get(TaskIndexData $data): ?Collection
    {
        return $data->hasFilter()
            ? $this->getByFilter($data)
            : $this->getTask();
    }

    public function getOrder(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    public function getAllFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->whereRaw($this->filter->fullTextFilter(), [$data->getTitle()])
            ->get();
    }

     public function getOrderAllFilter(TaskIndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->whereRaw($this->filter->fullTextFilter(), [$data->getTitle()])
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    public function updateById(TaskUpdateData $data): ?int
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $data->getId())
            ->update($data->getData()->toArray());
    }

    public function create(TaskCreateData $data): ?Task
    {
        return Task::create(array_merge(
            ['user_id' => Auth::id()],
            $data->getData()->toArray()),
        );
    }

    public function doneStatus(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->where('status', TaskStatusEnum::DONE->value)
            ->first();
    }

    public function delete(int $id): ?int
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->delete();
    }

    public function complete(int $id): ?int
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $id)
            ->update([
                'status' => TaskStatusEnum::DONE->value,
                'completed_at' => now(),
            ]);
    }

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
