<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\Factories\TaskUpdateDataFactory;
use App\Exceptions\Task\TaskServiceException;
use App\Repositories\TaskRepository;
use App\Services\AbstractService;
use App\Services\ResponseService;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateService extends AbstractService
{
    public function __construct(
        protected TaskUpdateDataFactory $updateDataFactory,
        protected TaskRepository        $task,
        protected ResponseService       $response,
    )
    {
    }

    public function update(): ResponseService
    {
        DB::beginTransaction();

        try {
            $data = $this->updateDataFactory->getValidData();

            $result = $this->task->updateById($data);

            if (!$result) {
                throw new TaskServiceException(
                    message: __('task.not_found', ['id' => $data->getId()]),
                );
            }

            $result = $this->task->getById($data->getId());

            $this->response->setTaskUpdateData($result);

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }
}
