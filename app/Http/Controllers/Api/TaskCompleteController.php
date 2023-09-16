<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CompleteService;
use Illuminate\Http\JsonResponse;

class TaskCompleteController extends Controller
{
    use ServiceMapper;

    /**
     * @param CompleteService $completeService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected CompleteService $completeService,
        protected AnswerService   $answerService,
    )
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function complete(int $id): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->completeService, 'complete', $id);

        return $this->answerService->getJsonResponse();
    }
}
