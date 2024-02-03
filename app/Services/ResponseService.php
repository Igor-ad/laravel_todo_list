<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\Response\ResponseData;
use App\Data\Response\Factories\ResponseDataFactory;
use Symfony\Component\HttpFoundation\Response;

class ResponseService
{
    use ResponseSetters;

    public ResponseData $responseData;

    public function setResponseData(
        string          $message,
        int|object|null $data,
        int             $status = Response::HTTP_OK,
    ): void
    {
        $this->responseData = ResponseDataFactory::getDTO(collect([
            $status, $message, $data
        ]));
    }

}
