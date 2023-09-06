<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskCompleteService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskCompleteController extends Controller
{
    /**
     * @param TaskCompleteService $completeService
     */
    public function __construct(
        protected TaskCompleteService $completeService,
    )
    {
        parent::__construct(answerService: $this->answerService);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function complete(int $id): JsonResponse
    {
        try {
            $response = $this->completeService->complete($id);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

}
