<?php

namespace App\Services\Task;

use App\Data\Request\Factories\TaskUpdateDataFactory;
use App\Services\ResponseService;
use App\Exceptions\ProcessingException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateService
{
    public function __construct(
        protected TaskUpdateDataFactory $updateDataFactory,
        protected ResponseService       $response,
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

            $result = User::find(Auth::id())->tasks()
                ->where('id', $data->getId())
                ->update($data->getData()->toArray());

            if (!$result) {
                throw new ProcessingException(
                    message: __('task.not_found', ['id' => $data->getId()]),
                );
            }

            $result = User::find(Auth::id())->tasks()
                ->where('id', $data->getId())
                ->first();

            $this->response->setTaskUpdateData($result);

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $this->response;
    }
}
