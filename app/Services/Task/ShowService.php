<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\ServiceException;
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

    /**
     * @throws ServiceException
     */
    public function show(int $id): ResponseService
    {
        return $this->setOrException(
            $this->task->getById($id), $id
        );
    }

    /**
     * @throws ServiceException
     */
    public function showWithBranches(int $id): ResponseService
    {
        return $this->setOrException(
            $this->task->getByIdWithBranches($id), $id
        );
    }

    /**
     * @throws ServiceException
     */
    public function showWithChildren(int $id): ResponseService
    {
        return $this->setOrException(
            $this->task->getByIdWithChildren($id), $id
        );
    }

    /**
     * @throws ServiceException
     */
    public function showWithParent(int $id): ResponseService
    {
        return $this->setOrException(
            $this->task->getByIdWithParent($id), $id
        );
    }

    /**
     * @throws ServiceException
     */
    public function showWithParents(int $id): ResponseService
    {
        return $this->setOrException(
            $this->task->getByIdWithParents($id), $id
        );
    }

    /**
     * @throws ServiceException
     */
    public function getChildrenIdStatus(object $collect, string $relation): ResponseService
    {
        return $this->setOrException(
            $collect->$relation->pluck('status', 'id'), $collect->id
        );
    }

    /**
     * @throws ServiceException
     */
    public function getRelationIdStatus(object $model, string $relation): ResponseService
    {
        $relateId = collect();

        while ($model->$relation) {
            $relateId->put($model->$relation->id, $model->$relation->status);
            $model = $model->$relation;
        }

        return $this->setOrException(
            $relateId, $model->id
        );
    }

    /**
     * @throws ServiceException
     */
    private function setOrException(mixed $data, int $id): ResponseService
    {
        if ($data) {
            $this->response->setShowData($id, $data);

            return $this->response;
        }
        throw new ServiceException(__('task.not_found', ['id' => $id]),);
    }
}
