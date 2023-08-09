<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(
        protected TaskRepository $repository,
    )
    {
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id): mixed
    {
        return $this->repository->getTask($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data): mixed
    {
        $this->repository->updateTask($data);

        return $this->repository->getTask($data['id']);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function add(array $data): mixed
    {
        return $this->repository->storeTask($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function del(int $id): mixed
    {
        $status = $this->repository->doneStatusTask($id);

        if ($status) {
            return $status;
        }
        return $this->repository->eraseTask($id);
    }

}
