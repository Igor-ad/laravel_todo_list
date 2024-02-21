<?php

declare(strict_types=1);

namespace App\Exceptions\Task;

use Symfony\Component\HttpFoundation\Response;

class AuthException extends TaskException
{
    public function setCustomMessage(): void
    {
        $this->customMessage = (
        sprintf("%s 'eMsg: %s'",
            __('exception.unauthenticated'),
            $this->getMessage()
        ));
    }

    public function setStatusCode(): void
    {
        $this->statusCode = (Response::HTTP_UNAUTHORIZED);
    }
}
