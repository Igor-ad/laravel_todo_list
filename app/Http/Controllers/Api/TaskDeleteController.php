<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\DeleteService;
use Illuminate\Http\JsonResponse;

class TaskDeleteController extends Controller
{
    use ServiceMapper;

    /**
     * @param DeleteService $deleteService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected DeleteService $deleteService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public
    function delete(int $id): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->deleteService, 'delete', $id);

        return $this->answerService->getJsonResponse();
    }
}
