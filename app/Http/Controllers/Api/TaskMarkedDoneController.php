<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\JsonResponse;

class TaskMarkedDoneController extends TaskHelper
{

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function done(int $id): JsonResponse
    {
        try {
            $this->ans->data = $this->markedDoneService->decisionChildTodo($id);
            $this->ans->status = 200;

            if ($this->ans->data) {
                $this->ans->message = __('task.market_done', ['id' => $id]);
            } else {
                $this->ans->message = __('task.market_done_fail', ['id' => $id]);
            }
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans, $this->ans->status);
    }

}
