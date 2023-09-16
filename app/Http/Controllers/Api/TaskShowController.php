<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\ShowService;
use Illuminate\Http\JsonResponse;

class TaskShowController extends Controller
{
    use ServiceMapper;

    /**
     * @param ShowService $showService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected ShowService   $showService,
        protected AnswerService $answerService,
    )
    {
    }

    public function show(int $id): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->showService, 'show', $id);

        return $this->answerService->getJsonResponse();
    }
}
