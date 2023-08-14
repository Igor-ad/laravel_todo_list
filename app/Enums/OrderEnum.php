<?php

namespace App\Enums;

enum OrderEnum: string
{
    case priority = 'prioritySort';
    case created_at = 'createdSort';
    case completed_at = 'completedSort';
}
