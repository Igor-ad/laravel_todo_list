<?php

namespace App\Services;

use App\Data\ResponseData;
use Database\Factories\ResponseDataFactory;

class ResponseService
{
    use ResponseSetters;

    public ResponseData $responseData;

    /**
     * @param int $status
     * @param string $message
     * @param bool|object|null $data
     * @return void
     */
    public function setResponseData(
        int              $status,
        string           $message,
        bool|object|null $data
    ): void
    {
        $this->responseData = ResponseDataFactory::responseData(
            status: $status,
            message: $message,
            data: $data
        );
    }

}
