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
            if (is_null($this->ans->data)) {
                $this->ans->message = __('task.not_found', ['id' => $id]);
            } else {
                $this->ans->message = __('task.show', ['id' => $id]);
            }
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
    public function add(TaskRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $this->ans->status = 201;
            $this->ans->data = $this->taskService->add($data);
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
    public function del(int $id): JsonResponse
    {
        try {
            $this->ans->status = 200;
            $this->ans->data = $this->taskService->del($id);
            if (is_object($this->ans->data)) {
                $this->ans->message = __('task.delete_fail', ['id' => $id]);
            } else {
                $this->ans->message = __('task.delete_success', ['id' => $id]);
            }
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
