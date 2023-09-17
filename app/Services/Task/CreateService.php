<?php

namespace App\Services\Task;

use App\Data\Request\Factories\TaskCreateDataFactory;
use App\Models\Task;
use App\Services\ResponseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use RuntimeException;

class CreateService
{
    public function __construct(
        protected TaskCreateDataFactory $createDataFactory,
        protected ResponseService       $response,
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

            $result = Task::create(array_merge(
                ['user_id' => Auth::id()],
                $data->getData()->toArray()),
            );

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
