<?php

declare(strict_types=1);

namespace App\Services;

use BadMethodCallException;

class AbstractService
{
    public function __call(string $name, array $arguments)
    {
        throw new BadMethodCallException(
            $this->badMethodMessage($this, $name),
        );
    }

    private function badMethodMessage(object $class, string $method): string
    {
        return __('exception.not_allowed_method', [
                'method' => $method,
                'class' => class_basename($class)
            ]);
    }
}
