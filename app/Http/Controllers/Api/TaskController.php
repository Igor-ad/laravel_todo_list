<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as parentAlias;
use App\Http\Requests\Api\TaskRequest;
use App\Http\Requests\Api\TaskUpdateRequest;
use App\Services\TaskService;
use Database\Factories\TaskUpdateDataFactory;
use Database\Factories\TaskCreateDataFactory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends parentAlias
{
    /**
     * @param TaskService $taskService
     * @param TaskUpdateDataFactory $updateDataFactory
     * @param TaskCreateDataFactory $createDataFactory
     */
    public function __construct(
        protected TaskService           $taskService,
        protected TaskUpdateDataFactory $updateDataFactory,
        protected TaskCreateDataFactory $createDataFactory,
    )
    {
        parent::__construct(answerService: $this->answerService);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $response = $this->taskService->show($id);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

    /**
     * @param TaskUpdateRequest $request
     * @return JsonResponse
     */
    public function update(TaskUpdateRequest $request): JsonResponse
    {
        $validData = $this->updateDataFactory->getValidData($request);

        try {
            $response = $this->taskService->update($validData);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

    /**
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function create(TaskRequest $request): JsonResponse
    {
        $validData = $this->createDataFactory->getValidData(Auth::id(), $request);

        try {
            $response = $this->taskService->create($validData);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        try {
            $response = $this->taskService->delete($id);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

}
