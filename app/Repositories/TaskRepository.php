<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\Request\TaskDTO\CreateData;
use App\Data\Request\TaskDTO\IndexData;
use App\Data\Request\TaskDTO\UpdateData;
use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Services\Task\FilterService;
use App\Services\Task\OrderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    public function __construct(
        protected FilterService $filter,
        protected OrderService  $order,
    ) {
    }

    public function getById(int $id): Task
    {
        return $this->getUserTasks()->getById($id);
    }

    public function getByIdWithBranches(int $id): Task
    {
        return $this->getUserTasks()
            ->with(['branches'])
            ->getById($id);
    }

    public function hasChildrenStatusTodo(int $id): Task
    {
        return $this->getUserTasks()
            ->withCount(['children' => function ($query) {
                $query->where('status', '=', 'todo');
            }])
            ->getById($id);
    }

    public function getByIdWithChildren(int $id): Task
    {
        return $this->getUserTasks()
            ->with(['children'])
            ->getById($id);
    }

    public function getByIdWithParent(int $id): Task
    {
        return $this->getUserTasks()
            ->with(['parent'])
            ->getById($id);
    }

    public function getByIdWithParents(int $id): Task
    {
        return $this->getUserTasks()
            ->with(['parents'])
            ->getById($id);
    }

    public function getTask(): Collection
    {
        return $this->getUserTasks()->get();
    }

    public function getByFilter(IndexData $data): Collection
    {
        return $this->getUserTasks()
            ->where($this->filter->filter($data))
            ->get();
    }

    public function get(IndexData $data): Collection
    {
        return $data->hasFilter()
            ? $this->getByFilter($data)
            : $this->getTask();
    }

    public function getOrder(IndexData $data): Collection
    {
        return $this->getUserTasks()
            ->where($this->filter->filter($data))
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    public function getAllFilter(IndexData $data): Collection
    {
        return $this->getUserTasks()
            ->where($this->filter->filter($data))
            ->whereRaw($this->filter->fullTextFilter(), [$data->getTitle()])
            ->get();
    }

    public function getOrderAllFilter(IndexData $data): Collection
    {
        return $this->getUserTasks()
            ->where($this->filter->filter($data))
            ->whereRaw($this->filter->fullTextFilter(), [$data->getTitle()])
            ->orderByRaw($this->order->orderExpression($data))
            ->get();
    }

    public function updateById(int $id, UpdateData $data): int
    {
        return $this->getUserTasks()
            ->where('id', $id)
            ->update($data->getData()->toArray());
    }

    public function create(CreateData $data): ?Task
    {
        return Task::create(array_merge(
            ['user_id' => Auth::id()],
            $data->getData()->toArray()),
        );
    }

    public function hasStatusDone(int $id): ?Task
    {
        return $this->getUserTasks()
            ->where('status', TaskStatusEnum::DONE->value)
            ->getById($id);
    }

    public function delete(int $id): int
    {
        return $this->getUserTasks()
            ->where('id', $id)
            ->where('status', TaskStatusEnum::TODO->value)
            ->delete();
    }

    public function complete(int $id): int
    {
        return $this->getUserTasks()
            ->where('id', $id)
            ->update([
                'status' => TaskStatusEnum::DONE->value,
                'completed_at' => now(),
            ]);
    }

    private function getUserTasks(): Builder
    {
        return Task::query()->where('user_id', auth()->id());
    }
}
