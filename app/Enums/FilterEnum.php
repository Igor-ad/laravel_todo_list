<?php

namespace App\Enums;

enum FilterEnum: string
{
    case status = '=';
    case priority = '>=';
}
