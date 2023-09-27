<?php

namespace App\Enums;

enum TaskPathEnum: string
{
    case API = '/api';
    case index = '/tasks/';
    case show = '/tasks/show/';
    case add = '/tasks/add/';
    case complete = '/tasks/complete/';
    case edit = '/tasks/edit/';
    case create = '/tasks/create/';
    case update = '/tasks/update/';
    case delete = '/tasks/delete/';
}
