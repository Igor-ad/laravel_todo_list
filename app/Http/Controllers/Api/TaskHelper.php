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
}
