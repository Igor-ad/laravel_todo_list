<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function jsonResponse(
        string $message,
        bool $success = true,
        mixed $data = null,
        int $status = 200
    ): JsonResponse {
        return response()->json(
            data: [
                'success' => $success,
                'message' => $message,
                'data' => $data,
            ],
            status: $status,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
