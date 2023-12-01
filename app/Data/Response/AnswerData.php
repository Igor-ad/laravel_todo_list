<?php

declare(strict_types=1);

namespace App\Data\Response;

use Illuminate\Support\Collection;

class AnswerData implements ResponseDataInterface
{
    public function __construct(
        private readonly int                   $status,
        private readonly string                $message,
        private readonly object|array|int|null $data = null,
        private readonly int|string|null       $code = null,
    )
    {
    }

    public function getData(): Collection
    {
        return collect([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'code' => $this->code,
        ])->whereNotNull();
    }

    public function getPropData(): array|bool|null|object
    {
        return $this->data;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function equals(self $anotherOne): bool
    {
        return $this->getData()->toArray() === $anotherOne->getData()->toArray();
    }
}
