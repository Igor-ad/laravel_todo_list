<?php

namespace App\Exceptions\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskAuthException extends TaskException
{
    public function render(Request $request): JsonResponse
    {
        return response()->json(
            data: [
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => sprintf(
                    "%s 'eMsg: %s'",
                    __('exception.unauthenticated'), $this->getMessage()
                ),
                'help' => __('exception.help'),
                'code' => $this->getCode(),
            ],
            status: Response::HTTP_UNAUTHORIZED,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
