<?php

namespace App\Http\Controllers\Api;

use App\Data\AnswerData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskRequest;
use App\Http\Requests\Api\TaskUpdateRequest;
use App\Services\TaskService;
use Database\Factories\TaskUpsertDataFactory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use TaskHelper;

    /**
     * @param TaskService $taskService
     * @param TaskUpsertDataFactory $upsertDataFactory
     * @param AnswerData $ans
     */
    public function __construct(
        protected TaskService           $taskService,
        protected TaskUpsertDataFactory $upsertDataFactory,
        protected AnswerData            $ans,
    )
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $this->ans->status = 200;
            $this->ans->data = $this->taskService->show($id);
            $this->ans->message = is_null($this->ans->data)
                ? __('task.not_found', ['id' => $id])
                : __('task.show', ['id' => $id]);
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

    /**
     * @param TaskUpdateRequest $request
     * @return JsonResponse
     */
    public function update(TaskUpdateRequest $request): JsonResponse
    {
        $validData = $this->upsertDataFactory->getValidData($request);

        try {
            $this->ans->status = 200;
            $this->ans->data = $this->taskService->update($validData);
            $this->ans->message = __('task.update');
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

    /**
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function create(TaskRequest $request): JsonResponse
    {
        $validData = $this->upsertDataFactory->getValidData($request);
        $validData->user_id = Auth::id();
        try {
            $this->ans->status = 201;
            $this->ans->data = $this->taskService->create($validData);
            $this->ans->message = __('task.create');
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $this->ans->status = 200;
            $this->ans->data = $this->taskService->delete($id);
            $this->ans->message = is_object($this->ans->data)
                ? __('task.delete_fail', ['id' => $id])
                : __('task.delete_success', ['id' => $id]);
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
