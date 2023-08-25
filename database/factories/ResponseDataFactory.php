<?php

namespace Database\Factories;

use App\Data\ResponseData;

class ResponseDataFactory
{
    /**
     * @param int $status
     * @param string $message
     * @param bool|object|null $data
     * @return ResponseData
     */
    public static function responseData(
        int              $status,
        string           $message,
        bool|object|null $data
    ): ResponseData
    {
        return new ResponseData(
            status: $status,
            message: $message,
            data: $data
        );
    }
}
