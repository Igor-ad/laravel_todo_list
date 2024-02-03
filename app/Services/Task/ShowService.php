<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\Task\ServiceException;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;
use Illuminate\Support\Collection;

class ShowService extends AbstractService
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
    public function getChildrenId(object $collect, string $relation): ResponseService
    {
        return $this->setOrException(
            $collect->$relation->pluck('id'), $collect->id
        );
    }

    /**
     * @throws ServiceException
     */
    public function getRelationId(object $model, string $relation): ResponseService
    {
        $relateId = collect();

        while ($model->$relation) {
            $relateId->push($model->$relation->id);
            $model = $model->$relation;
        }

        return $this->setOrException(
            $relateId, $model->id
        );
    }

    /**
     * @throws ServiceException
     */
    private function setOrException(null|Collection|Task $result, int $id): ResponseService
    {
        if ($result) {
            $this->response->setShowData($id, $result);

            return $this->response;
        } else {
            throw new ServiceException(__('task.not_found', ['id' => $id]),);
        }
    }
}
