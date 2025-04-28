<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\CommonService;
use Illuminate\Support\Collection as Collect;

class ShowService extends CommonService
{
    public function __construct(
        protected TaskRepository  $task,
    ) {
    }

    public function show(int $id): Task
    {
        return $this->task->getById($id);
    }

    public function showWithBranches(int $id): Task
    {
        return $this->task->getByIdWithBranches($id);
    }

    public function showWithChildren(int $id): Task
    {
        return $this->task->getByIdWithChildren($id);
    }

    public function showWithParent(int $id): Task
    {
        return $this->task->getByIdWithParent($id);
    }

    public function showWithParents(int $id): Task
    {
        return $this->task->getByIdWithParents($id);
    }

    public function getChildrenIdStatus(object $collect, string $relation): Collect
    {
        return $collect->$relation->pluck('status', 'id');
    }

    public function getRelationIdStatus(object $model, string $relation): Collect
    {
        $relateId = collect();

        while ($model->$relation) {
            $relateId->put($model->$relation->id, $model->$relation->status);
            $model = $model->$relation;
        }
        return $relateId;
    }
}
