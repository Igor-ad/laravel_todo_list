<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\Request\TaskDTO\CreateData;
use App\Data\Request\TaskDTO\IndexData;
use App\Data\Request\TaskDTO\UpdateData;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;
use App\Services\Task\FilterService;
use App\Services\Task\OrderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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

    public function hasChildrenStatusTodo(int $id): ?Task
    {
        return User::find(Auth::id())->tasks()
            ->withCount(['children' => function ($q) {
                $q->where('status', '=', 'todo');
            }])
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

    public function getByFilter(IndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->get();
    }

    public function get(IndexData $data): ?Collection
    {
        return $data->hasFilter()
            ? $this->getByFilter($data)
            : $this->getTask();
    }

    public function getOrder(IndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    public function getAllFilter(IndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->whereRaw($this->filter->fullTextFilter(), [$data->getTitle()])
            ->get();
    }

    public function getOrderAllFilter(IndexData $data): ?Collection
    {
        return User::find(Auth::id())->tasks()
            ->where($this->filter->filter($data))
            ->whereRaw($this->filter->fullTextFilter(), [$data->getTitle()])
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    public function updateById(UpdateData $data): ?int
    {
        return User::find(Auth::id())->tasks()
            ->where('id', $data->getId())
            ->update($data->getData()->toArray());
    }

    public function create(CreateData $data): ?Task
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
            ->where('status', TaskStatusEnum::TODO->value)
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
}
