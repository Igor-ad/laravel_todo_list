<?php

namespace App\Data;

use Illuminate\Support\Collection;

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
     * @return Collection
     */
    public function getData(): Collection
    {
        return collect([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data,
            'code' => $this->code,
        ])->whereNotNull();
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
        return $this->getData()->toArray() === $anotherOne->getData()->toArray();
    }
}
