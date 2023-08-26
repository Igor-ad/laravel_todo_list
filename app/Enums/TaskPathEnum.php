<?php

namespace App\Enums;

enum TaskPathEnum: string
{
    case API = '/api';
    case index = '/tasks/';
    case show = '/tasks/show/';
    case complete = '/tasks/complete/';
    case create = '/tasks/create/';
    case update = '/tasks/update/';
    case delete = '/tasks/delete/';
    case login = '/login';

}
