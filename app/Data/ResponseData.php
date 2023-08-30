<?php

namespace App\Data;

/**
 * Response DTO
 */
class ResponseData
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
     * @return array
     */
    public function getData(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }

    /**
     * @param ResponseData $anotherOne
     * @return bool
     */
    public function equals(self $anotherOne): bool
    {
        return $this->getData() === $anotherOne->getData();
    }
}
