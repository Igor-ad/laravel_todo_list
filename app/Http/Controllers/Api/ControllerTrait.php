<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\JsonResponse;

trait ControllerTrait
{
    /**
     * @param Exception $e
     * @return void
     */
    protected function getCatch(Exception $e): void
    {
        $status = 500;
        $message = $e->getMessage();
        $code = $e->getCode();
        $this->setAData([$status, $message, $code]);
    }

    /**
     * @return JsonResponse
     */
    protected function getJsonResponse(): JsonResponse
    {
        return response()->json(
            data: [$this->aData->getData()],
            status: $this->aData->status
        );
    }
}
