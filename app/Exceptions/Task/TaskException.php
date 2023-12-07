<?php

namespace App\Exceptions\Task;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *  API-rendering of "Task Services" exceptions
 */
class TaskException extends Exception
{
    protected ?string $customMessage = null;

    protected array $data = [];

    protected int $statusCode = Response::HTTP_NOT_IMPLEMENTED;

    public function __construct(string $message)
    {
        parent::__construct($message);

        $this->setCustomMessage();
        $this->setStatusCode();
        $this->setData();
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(
            data: $this->data,
            status: $this->statusCode,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }

    public function setCustomMessage(): void
    {
    }

    public function getCustomMessage(): string
    {
        return $this->customMessage ?? $this->getMessage();
    }

    public function setData(): void
    {
        $this->data = $this->toArray();
    }

    public function setStatusCode(): void
    {
    }

    public function toArray(): array
    {
        return [
            'status' => $this->statusCode,
            'message' => [
                'error' => $this->getCustomMessage(),
            ],
            'help' => __('exception.help'),
            'code' => $this->getCode(),
        ];
    }
}
