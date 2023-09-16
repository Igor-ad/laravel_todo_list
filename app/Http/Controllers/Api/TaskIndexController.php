<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\IndexService;
use Illuminate\Http\JsonResponse;

class TaskIndexController extends Controller
{
    use ServiceMapper;

    /**
     * @param IndexService $indexService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected IndexService  $indexService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->indexService, 'index');

        return $this->answerService->getJsonResponse();
    }
}
