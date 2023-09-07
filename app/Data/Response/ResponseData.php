<?php

namespace App\Data\Response;

use Illuminate\Support\Collection;

/**
 * Response DTO
 */
class ResponseData implements ResponseDataInterface
{
    /**
     * @param int $status
     * @param string $message
     * @param bool|object|null $data
     */
    public function __construct(
        private readonly int              $status,
        private readonly string           $message,
        private readonly bool|object|null $data = null,
    )
    {
    }

    /**
     * @return Collection
     */
    public function getData(): Collection
    {
        return collect([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ]);
    }

    /**
     * @param ResponseData $anotherOne
     * @return bool
     */
    public function equals(self $anotherOne): bool
    {
        return $this->getData()->toArray() === $anotherOne->getData()->toArray();
    }
}
