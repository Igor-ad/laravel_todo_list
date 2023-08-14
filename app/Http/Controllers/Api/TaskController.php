<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskRequest;
use App\Http\Requests\Api\TaskUpdateRequest;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    use TaskHelper;

    /**
     * @param TaskService $taskService
     * @param object $ans
     */
    public function __construct(
        protected TaskService $taskService,
        protected object      $ans = new \stdClass,
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
        $data = $request->validated();
        try {
            $this->ans->status = 200;
            $this->ans->data = $this->taskService->update($data);
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
        $data = $request->validated();
        try {
            $this->ans->status = 201;
            $this->ans->data = $this->taskService->create($data);
            $this->ans->message = __('task.store');
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
