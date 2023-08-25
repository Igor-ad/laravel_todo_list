<?php

namespace App\Data;

class AnswerData
{
    /**
     * @param int $status
     * @param string $message
     * @param object|array|bool|null $data
     * @param int|string|null $code
     */
    public function __construct(
        public readonly int                    $status,
        public readonly string                 $message,
        public readonly object|array|bool|null $data,
        public readonly int|string|null        $code,
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
            'code' => $this->code,
        ];
    }
}
