<?php

declare(strict_types=1);

namespace App\Data\Response;

use Illuminate\Support\Collection;

final class AnswerData implements ResponseDataInterface
{
    public function __construct(
        private readonly int                   $status,
        private readonly string                $message,
        private readonly object|array|int|null $data,
        private readonly int|string|null       $code,
    )
    {
    }

    public static function fromCollect(array|Collection $collection): self
    {
        return new self(
            status: data_get($collection, 'status'),
            message: data_get($collection, 'message'),
            data: data_get($collection, 'data'),
            code: data_get($collection, 'code'),
        );
    }

    public function toCollect(): Collection
    {
        return collect([
            'status' => $this->status,
            'message' => $this->message,
            'code' => $this->code,
            'data' => $this->data,
        ]);
    }

    public function getCode(): int|string|null
    {
        return $this->code;
    }

    public function getData(): array|bool|null|object
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
        return $this->toCollect()->toArray() === $anotherOne->toCollect()->toArray();
    }
}
