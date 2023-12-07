<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Response\ResponseData;
use App\Data\Response\Factories\ResponseDataFactory;

class ResponseService
{
    use ResponseSetters;

    public ResponseData $responseData;

    public function setResponseData(
        int             $status,
        string          $message,
        int|object|null $data,
    ): void
    {
        $this->responseData = ResponseDataFactory::getDTO(collect([
            $status, $message, $data
        ]));
    }

}
