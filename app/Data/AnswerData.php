<?php

namespace App\Data;

class AnswerData
{
    /**
     * @param int|null $status
     * @param object|bool|null $data
     * @param string|null $message
     * @param int|null $code
     */
    public function __construct(
        public ?int             $status = null,
        public object|bool|null $data = null,
        public ?string          $message = null,
        public ?int             $code = null,
    )
    {
    }
}
