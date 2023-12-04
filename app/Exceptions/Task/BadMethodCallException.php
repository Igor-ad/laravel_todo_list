<?php

namespace App\Exceptions\Task;

use \Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BadMethodCallException extends TaskException
{
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'status' => Response::HTTP_NOT_IMPLEMENTED,
            'message' => $this->getMessage(),
            'data' => null,
            'code' => $this->getCode(),
        ],
            status: Response::HTTP_NOT_IMPLEMENTED,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
