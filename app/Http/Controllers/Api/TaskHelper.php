<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\JsonResponse;

trait TaskHelper
{
    /**
     * @param Exception $e
     * @return void
     */
    protected function getCatch(Exception $e): void
    {
        $this->ans->status = 500;
        $this->ans->message = $e->getMessage();
        $this->ans->code = $e->getCode();
    }

    /**
     * @return JsonResponse
     */
    protected function getJsonResponse(): JsonResponse
    {
        return response()->json(data: [$this->ans], status: $this->ans->status);
    }

    /**
     * @param int $status
     * @param string $method
     * @param string $msg
     * @param mixed $data
     * @return JsonResponse
     */
    protected function getMethod(int $status, string $method, string $msg, mixed $data): JsonResponse
    {
            try {
                $this->ans->status = $status;
                $this->ans->data = $this->taskService->{$method}($data);
                $this->ans->message = $msg;
            } catch (Exception $e) {
                $this->getCatch($e);
            }
            return $this->getJsonResponse();
    }
}
