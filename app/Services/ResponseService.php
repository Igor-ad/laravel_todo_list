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
        string          $message,
        int|object|null $data,
        ?int            $status = 200,
    ): self
    {
        $this->responseData = ResponseDataFactory::getDTO(collect(
            compact('status', 'message', 'data')
        ));
        return $this;
    }
}
