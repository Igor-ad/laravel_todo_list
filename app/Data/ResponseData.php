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
        public readonly int              $status,
        public readonly string           $message,
        public readonly bool|object|null $data = null,
    )
    {
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}