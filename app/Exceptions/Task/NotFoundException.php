<?php

namespace App\Exceptions\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends TaskException
{
    public function render(Request $request): JsonResponse
    {
        return response()->json(
            data: [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => __('exception.404', ['message' => $this->getMessage()]),
                'help' => __('exception.help'),
                'code' => $this->getCode(),
            ],
            status: Response::HTTP_NOT_FOUND,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
