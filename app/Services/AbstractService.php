<?php

declare(strict_types=1);

namespace App\Services;

use BadMethodCallException;

class AbstractService
{
    public function __call(string $name, array $arguments)
    {
        throw new BadMethodCallException(
            __('exception.not_allowed_method', [
                'method' => $name,
                'class' => class_basename($this)
            ]),
        );
    }
}
