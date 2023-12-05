<?php

namespace App\Exceptions\Task;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException as ValidatorException;
use Symfony\Component\HttpFoundation\Response;

class ValidationException extends ValidatorException
{
    public function render(Request $request): JsonResponse
    {
        return response()->json(
            data: [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => [
                    'errors' => $this->validator->errors()
                ],
                'help' => __('exception.help'),
                'code' => $this->getCode(),
            ],
            status: Response::HTTP_UNPROCESSABLE_ENTITY,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }
}
