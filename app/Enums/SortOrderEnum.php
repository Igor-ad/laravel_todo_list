<?php

namespace App\Enums;

/**
 *  Allowed sorting directions for GET request are set her
 *  Example:
 *  'UP', 'DOWN' or 'asc', 'desc'
 *  Default:
 *  'up', 'dw'
 *  GET http://127.0.0.1:80/api/tasks/?api_token=**********&prioritySort=dw
 */
enum SortOrderEnum: string
{
    case ASC = 'up';
    case DESC = 'dw';
}
