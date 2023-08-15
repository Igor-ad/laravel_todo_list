<?php

namespace App\Enums;

enum SortEnum: string
{
    case priority = 'prioritySort';
    case created_at = 'createdSort';
    case completed_at = 'completedSort';
}
