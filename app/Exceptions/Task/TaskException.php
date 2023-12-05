<?php

namespace App\Exceptions\Task;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskException extends Exception
{
    protected array $data = [];

    protected int $status = Response::HTTP_NOT_IMPLEMENTED;

    protected ?string $customMessage = null;

    public function __construct(string $message)
    {
        parent::__construct($message);

        $this->setStatus();
        $this->setCustomMessage();
        $this->setData();
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json(
            data: $this->getData(),
            status: $this->getStatus(),
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }

    public function setData(): void
    {
        $this->data = [
            'status' => $this->getStatus(),
            'message' => [
                'error' => $this->getCustomMessage(),
                ],
            'help' => __('exception.help'),
            'code' => $this->getCode(),
        ];
    }

    public function setStatus(): void
    {
    }

    public function setCustomMessage(): void
    {
    }

    public function getCustomMessage(): string
    {
        return $this->customMessage ?? $this->getMessage();
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
