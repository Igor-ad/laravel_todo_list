<?php

namespace App\Enums;

enum PathEnum: string
{
    case login = '/login';
    case register = '/register';
    case logout = '/logout';
    case welcome = '/';
}
