<?php

namespace App\Services\Task;

use App\Data\Request\Factories\TaskUpdateDataFactory;
use App\Repositories\TaskRepository;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use Exception;
use RuntimeException;

class UpdateService
{
    public function __construct(
        protected TaskUpdateDataFactory $updateDataFactory,
        protected ResponseService       $response,
        protected TaskRepository        $repository,
    )
    {
    }

    /**
     * @return ResponseService
     * @throws Exception
     */
    public function update(): ResponseService
    {
        DB::beginTransaction();

        try {
            $data = $this->updateDataFactory->getValidData();

            $result = $this->repository->updateById($data);

            if (!$result) {
                throw new RuntimeException(
                    message: __('task.not_found', ['id' => $data->getId()]),
                );
            }

            $result = $this->repository->getById($data->getId());

            $this->response->setTaskUpdateData($result);

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }
}
