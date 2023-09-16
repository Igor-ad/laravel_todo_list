<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\UpdateService;
use Illuminate\Http\JsonResponse;

class TaskUpdateController extends Controller
{
    use ServiceMapper;

    /**
     * @param UpdateService $updateService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected UpdateService $updateService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->updateService, 'update');

        return $this->answerService->getJsonResponse();
    }
}
