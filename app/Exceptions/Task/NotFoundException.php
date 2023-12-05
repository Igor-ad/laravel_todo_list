<?php

namespace App\Exceptions\Task;

use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends TaskException
{
    public function setStatus(): void
    {
        $this->status = Response::HTTP_NOT_FOUND;
    }

    public function setCustomMessage(): void
    {
        $this->customMessage = __('exception.404', ['message' => $this->getMessage()]);
    }
}
