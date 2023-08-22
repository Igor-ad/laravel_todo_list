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
            $data = $this->completeService->decisionChildTodo($id);
            $status = ($data)
                ? 200 : 501;
            $message = ($data)
                ? __('task.market_done', ['id' => $id])
                : __('task.market_done_fail', ['id' => $id]);
            $this->setAData([$status, $message, $data]);
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
