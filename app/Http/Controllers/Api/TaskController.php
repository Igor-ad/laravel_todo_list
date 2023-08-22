<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskRequest;
use App\Http\Requests\Api\TaskUpdateRequest;
use App\Services\TaskService;
use Database\Factories\AnswerDataFactory;
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
     */
    public function __construct(
        protected TaskService           $taskService,
        protected TaskUpsertDataFactory $upsertDataFactory,
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
            $data = $this->taskService->show($id);
            $status = is_null($data)
                ? 501 : 200;
            $message = is_null($data)
                ? __('task.not_found', ['id' => $id])
                : __('task.show', ['id' => $id]);
            $this->aData = AnswerDataFactory::answerData([$status, $message, $data]);
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
        $validData = $this->upsertDataFactory->getValidData($request, null);

        try {
            $status = 200;
            $data = $this->taskService->update($validData);
            $message = __('task.update');
            $this->aData = AnswerDataFactory::answerData([$status, $message, $data]);
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
        $validData = $this->upsertDataFactory->getValidData($request, Auth::id());
        try {
            $status = 201;
            $data = $this->taskService->create($validData);
            $message = __('task.create');
            $this->aData = AnswerDataFactory::answerData([$status, $message, $data]);
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
            $data = $this->taskService->delete($id);
            $status = is_bool($data)
                ? 200 : 501;
            $message = is_object($data)
                ? __('task.delete_fail', ['id' => $id])
                : __('task.delete_success', ['id' => $id]);
            $this->aData = AnswerDataFactory::answerData([$status, $message, $data]);
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
