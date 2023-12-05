<?php

namespace App\Exceptions\Task;

use Symfony\Component\HttpFoundation\Response;

class AuthException extends TaskException
{
    public function setStatus(): void
    {
        $this->status = (Response::HTTP_UNAUTHORIZED);
    }

    public function setCustomMessage(): void
    {
        $this->customMessage = (
        sprintf("%s 'eMsg: %s'",
            __('exception.unauthenticated'),
            $this->getMessage()
        ));
    }
}
