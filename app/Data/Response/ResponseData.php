<?php

declare(strict_types=1);

namespace App\Data\Response;

use Illuminate\Support\Collection;

/**
 * Response DTO
 */
final class ResponseData implements ResponseDataInterface
{
    public function __construct(
        private readonly int             $status,
        private readonly string          $message,
        private readonly int|object|null $data,
    )
    {
    }

    public static function fromCollect(array|Collection $collection): self
    {
        return new self(
            status: data_get($collection, 'status'),
            message: data_get($collection, 'message'),
            data: data_get($collection, 'data'),
        );
    }

    public function getData(): object|int|null
    {
        return $this->data;
    }

    public function toCollect(): Collection
    {
        return collect([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ]);
    }

    public function equals(self $anotherOne): bool
    {
        return $this->toCollect()->toArray() === $anotherOne->toCollect()->toArray();
    }
}
