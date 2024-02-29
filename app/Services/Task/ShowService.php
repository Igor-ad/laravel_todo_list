<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Repositories\TaskRepository;
use App\Services\CommonService;
use App\Services\ResponseService;

class ShowService extends CommonService
{
    public function __construct(
        protected TaskRepository  $task,
        protected ResponseService $response,
    )
    {
    }

    public function show(int $id): ResponseService
    {
        return $this->setResponse(
            $this->task->getById($id), $id
        );
    }

    public function showWithBranches(int $id): ResponseService
    {
        return $this->setResponse(
            $this->task->getByIdWithBranches($id), $id
        );
    }

    public function showWithChildren(int $id): ResponseService
    {
        return $this->setResponse(
            $this->task->getByIdWithChildren($id), $id
        );
    }

    public function showWithParent(int $id): ResponseService
    {
        return $this->setResponse(
            $this->task->getByIdWithParent($id), $id
        );
    }

    public function showWithParents(int $id): ResponseService
    {
        return $this->setResponse(
            $this->task->getByIdWithParents($id), $id
        );
    }

    public function getChildrenIdStatus(object $collect, string $relation): ResponseService
    {
        return $this->setResponse(
            $collect->$relation->pluck('status', 'id'), $collect->id
        );
    }

    public function getRelationIdStatus(object $model, string $relation): ResponseService
    {
        $relateId = collect();

        while ($model->$relation) {
            $relateId->put($model->$relation->id, $model->$relation->status);
            $model = $model->$relation;
        }

        return $this->setResponse(
            $relateId, $model->id
        );
    }

    private function setResponse(mixed $data, int $id): ResponseService
    {
        return $this->response->setShowData($id, $data);
    }
}
