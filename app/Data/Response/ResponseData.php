<?php

declare(strict_types=1);

namespace App\Data\Response;

use Illuminate\Support\Collection;

/**
 * Response DTO
 */
class ResponseData implements ResponseDataInterface
{
    public function __construct(
        private readonly int              $status,
        private readonly string           $message,
        private readonly bool|object|null $data = null,
    )
    {
    }

    public function getData(): Collection
    {
        return collect([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ]);
    }

    public function equals(self $anotherOne): bool
    {
        return $this->getData()->toArray() === $anotherOne->getData()->toArray();
    }
}
