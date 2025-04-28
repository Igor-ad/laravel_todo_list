<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use App\Facades\Task\Complete as Completer;

class CompleteController extends BaseApiController
{
    public function complete(int $id): JsonResponse
    {
        return $this->jsonResponse(
            message:  __('task.complete', ['id' => $id]),
            success: (bool)Completer::complete($id),
        );
    }
}
