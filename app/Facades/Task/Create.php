<?php

declare(strict_types=1);

namespace App\Facades\Task;

use Illuminate\Support\Facades\Facade;

class Create extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Creator';
    }
}
