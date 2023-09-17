<?php

namespace App\Services\Task;

use App\Data\Request\Factories\TaskCreateDataFactory;
use App\Repositories\TaskRepository;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use Exception;
use RuntimeException;

class CreateService
{
    public function __construct(
        protected TaskCreateDataFactory $createDataFactory,
        protected ResponseService       $response,
        protected TaskRepository        $repository,
    )
    {
    }

    /**
     * @return ResponseService
     * @throws Exception
     */
    public function create(): ResponseService
    {
        DB::beginTransaction();
        try {
            $data = $this->createDataFactory->getValidData();

            $result = $this->repository->create($data);

            if (!$result) {
                throw new RuntimeException(
                    message: __('task.create_fail')
                );
            }

            $this->response->setTaskCreateData($result);

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }
}
