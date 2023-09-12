<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnswerService;
use App\Services\Task\IndexService;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskIndexController extends Controller
{
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
        try {
            $response = $this->indexService->index();

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }

}
