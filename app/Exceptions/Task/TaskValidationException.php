<?php

namespace App\Exceptions\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use \Symfony\Component\HttpFoundation\Response;

class TaskValidationException extends ValidationException
{
    public function render(Request $request): JsonResponse
    {
        return response()->json(
            data: [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => $this->validator->errors(),
            ],
            status: Response::HTTP_UNPROCESSABLE_ENTITY,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
