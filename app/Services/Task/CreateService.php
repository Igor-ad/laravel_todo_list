<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\TaskCreateDataFactory;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use Exception;
use RuntimeException;

class CreateService extends AbstractService
{
    public function __construct(
        protected TaskCreateDataFactory $createDataFactory,
        protected ResponseService       $response,
        protected TaskRepository        $task,
    )
    {
    }

    public function create(): ResponseService
    {
        DB::beginTransaction();
        try {
            $data = $this->createDataFactory->getValidData();

            $result = $this->task->create($data);

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
