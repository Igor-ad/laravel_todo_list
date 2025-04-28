<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Delete as Eraser;
use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;

class DeleteController extends BaseApiController
{
    public function delete(int $id): JsonResponse
    {
        return $this->jsonResponse(
            message: __('task.delete_success', ['id' => $id]),
            success: (bool)Eraser::delete($id),
        );
    }
}
