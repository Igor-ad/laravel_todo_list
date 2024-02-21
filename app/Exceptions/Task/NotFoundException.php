<?php

declare(strict_types=1);

namespace App\Exceptions\Task;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends TaskException
{
    public function setCustomMessage(): void
    {
        $this->customMessage = __('exception.404', ['message' => $this->getMessage()]);
    }

    public function setStatusCode(): void
    {
        $this->statusCode = Response::HTTP_NOT_FOUND;
    }
}
