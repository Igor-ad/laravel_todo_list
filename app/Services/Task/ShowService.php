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
        $result = $this->task->getById($id);

        $this->setOrException($result, $id);

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    public function showWithBranches(int $id): ResponseService
    {
        $result = $this->task->getByIdWithBranches($id);

        $this->setOrException($result, $id);

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    public function showWithChildren(int $id): ResponseService
    {
        $result = $this->task->getByIdWithChildren($id);

        $this->setOrException($result, $id);

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    public function showWithParent(int $id): ResponseService
    {
        $result = $this->task->getByIdWithParent($id);

        $this->setOrException($result, $id);

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    public function showWithParents(int $id): ResponseService
    {
        $result = $this->task->getByIdWithParents($id);

        $this->setOrException($result, $id);

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    public function getChildrenId(object $result, string $relation): ResponseService
    {
        $relateId = [];

        foreach ($result->$relation as $children) {
            $relateId[] = $children->id;
        }
        $collect = collect($relateId);
        $this->setOrException($collect, $result->id);

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    public function getRelationId(object $result, string $relation): ResponseService
    {
        $relateId = [];
        if ($relation == 'children') {
            dd($result);
        }
        while ($result->$relation) {
            $relateId[] = $result->$relation->id;
            $result = $result->$relation;
        }
        $collect = collect($relateId);
        $this->setOrException($collect, $result->id);

        return $this->response;
    }

    /**
     * @throws ServiceException
     */
    private function setOrException(null|Collection|Task $result, int $id): void
    {
        if ($result) {
            $this->response->setShowData($id, $result);
        } else {
            throw new ServiceException(__('task.not_found', ['id' => $id]),);
        }
    }
}
