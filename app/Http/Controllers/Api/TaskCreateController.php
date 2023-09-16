<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CreateService;
use Illuminate\Http\JsonResponse;

class TaskCreateController extends Controller
{
    use ServiceMapper;

    /**
     * @param CreateService $createService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected CreateService $createService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->createService, 'create');

        return $this->answerService->getJsonResponse();
    }
}
