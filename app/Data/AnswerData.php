<?php

namespace App\Data;

class AnswerData
{
    /**
     * @param int $status
     * @param string $message
     * @param object|bool|null $data
     * @param int|string|null $code
     */
    public function __construct(
        public readonly int              $status,
        public readonly string           $message,
        public readonly object|bool|null $data = null,
        public readonly int|string|null  $code = null,
    )
    {
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return array_diff([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'code' => $this->code,
        ], [null]);
    }
}
