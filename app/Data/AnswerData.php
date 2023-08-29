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
        private readonly int                    $status,
        private readonly string                 $message,
        private readonly object|array|bool|null $data = null,
        private readonly int|string|null        $code = null,
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

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param AnswerData $anotherOne
     * @return bool
     */
    public function equals(self $anotherOne): bool
    {
        return $this->getData() === $anotherOne->getData();
    }
}
