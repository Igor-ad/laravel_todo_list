<?php

namespace App\Http\Controllers\Api;

use App\Data\AnswerData;
use App\Http\Controllers\Controller;
use App\Services\TaskCompleteService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskCompleteController extends Controller
{
    use TaskHelper;

    /**
     * @param TaskCompleteService $markedDoneService
     * @param object $ans
     */
    public function __construct(
        protected TaskCompleteService $markedDoneService,
        protected AnswerData          $ans,
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
            $this->ans->data = $this->markedDoneService->decisionChildTodo($id);
            $this->ans->status = ($this->ans->data)
                ? 200 : 501;
            $this->ans->message = ($this->ans->data)
                ? __('task.market_done', ['id' => $id])
                : __('task.market_done_fail', ['id' => $id]);
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
