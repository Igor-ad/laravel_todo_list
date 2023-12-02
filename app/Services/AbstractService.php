<?php

declare(strict_types=1);

namespace App\Services;

use BadMethodCallException;

class AbstractService
{
    public function __call(string $name, array $arguments)
    {
        $class = class_basename($this);

        throw new BadMethodCallException(
            self::badMethodMessage($class, $name),
        );
    }

    public static function __callStatic(string $name, array $arguments)
    {
        $class = class_basename(static::class);

        throw new BadMethodCallException(
            self::badMethodMessage($class, $name) . ' Static context'
        );
    }

    public static function badMethodMessage(string $className, string $method): string
    {
        return __('exception.not_allowed_method', [
            'method' => $method,
            'class' => $className
        ]);
    }
}
