<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskMarkedDoneService;
use Exception;
use Illuminate\Http\JsonResponse;

class TaskMarkedDoneController extends Controller
{
    use TaskHelper;

    /**
     * @param TaskMarkedDoneService $markedDoneService
     * @param object $ans
     */
    public function __construct(
        protected TaskMarkedDoneService $markedDoneService,
        protected object                $ans = new \stdClass,
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
            $this->ans->status = 200;
            $this->ans->data = $this->markedDoneService->decisionChildTodo($id);
            $this->ans->message = ($this->ans->data)
                ? __('task.market_done', ['id' => $id])
                : __('task.market_done_fail', ['id' => $id]);
        } catch (Exception $e) {
            $this->getCatch($e);
        }
        return $this->getJsonResponse();
    }

}
