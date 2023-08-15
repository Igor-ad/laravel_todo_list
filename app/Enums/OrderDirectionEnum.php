<?php

namespace App\Enums;

/**
 *  Allowed sorting directions for GET request are set her
 *  Example:
 *  'UP', 'DOWN'
 */
enum OrderDirectionEnum: string
{
    case ASC = 'up';
    case DESC = 'dw';
}
