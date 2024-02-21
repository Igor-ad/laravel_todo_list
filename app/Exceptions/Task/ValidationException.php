<?php

declare(strict_types=1);

namespace App\Exceptions\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as ValidatorException;
use Symfony\Component\HttpFoundation\Response;

class ValidationException extends ValidatorException
{
    public function render(Request $request): JsonResponse
    {
        $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;

        return response()->json(
            data: [
                'status' => $statusCode,
                'message' => [
                    'errors' => $this->validator->errors()
                ],
                'help' => __('exception.help'),
                'code' => $this->getCode(),
            ],
            status: $statusCode,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
