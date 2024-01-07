<?php

namespace App\Enums;

enum FilterEnum: string
{
    case status = '=';
    case priority = '>=';

    public static function nameToArray(): array
    {
        return array_column(self::cases(), 'name');
    }
}
