<?php

namespace App\Exceptions\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceException extends TaskException
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
