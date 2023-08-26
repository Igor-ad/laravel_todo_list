<?php

namespace App\Enums;

enum TaskPathEnum: string
{
    case index = '/api/tasks/';
    case show = '/api/tasks/show/';
    case complete = '/api/tasks/complete/';
    case create = '/api/tasks/create/';
    case update = '/api/tasks/update/';
    case delete = '/api/tasks/delete/';

}
