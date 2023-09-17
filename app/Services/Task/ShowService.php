<?php

namespace App\Services\Task;

use App\Repositories\TaskRepository;
use App\Services\ResponseService;
use RuntimeException;

class ShowService
{
    public function __construct(
        protected TaskRepository  $repository,
        protected ResponseService $response,
    )
    {
    }

    /**
     * @param int $id
     * @return ResponseService
     * @throws RuntimeException
     */
    public function show(int $id): ResponseService
    {
        $result = $this->repository->getById($id);

        if ($result) {
            $this->response->setTaskShowData($id, $result);
        } else {
            throw new RuntimeException(
                message: __('task.not_found', ['id' => $id]),
            );
        }
        return $this->response;
    }
}
