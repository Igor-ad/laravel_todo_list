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
        $this->data->id = $id;

        try {
            $this->ans->data = $this->markedDoneService->decisionChildTodo($this->data);
            $this->ans->status = 200;

            if ($this->ans->data) {
                $this->ans->message = "Task ID: $id was marked 'done' successfully";
            } else {
                $this->ans->message = "One or more children of Task ID: $id have status 'done'";
            }
        } catch (Exception $e) {
            $this->ans->status = 500;
            $this->ans->error = $e->getMessage();
        }
        return response()->json($this->ans, $this->ans->status);
    }

}
