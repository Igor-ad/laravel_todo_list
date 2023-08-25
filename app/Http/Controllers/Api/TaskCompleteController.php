<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskCompleteService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskCompleteController extends Controller
{
    use ControllerTrait, AnswerTrait;

    /**
     * @param TaskCompleteService $completeService
     */
    public function __construct(
        protected TaskCompleteService $completeService,
    )
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function complete(int $id): JsonResponse
    {
        try {
            $response = $this->completeService->complete($id);

            $this->setAnswer($response);

        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
