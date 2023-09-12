<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AnswerService;
use App\Services\Task\ShowService;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskShowController extends Controller
{
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

    /**
     * @param int $id
     * @return JsonResponse
     */
    public
    function show(int $id): JsonResponse
    {
        try {
            $response = $this->showService->show($id);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService->getJsonResponse();
    }
}
