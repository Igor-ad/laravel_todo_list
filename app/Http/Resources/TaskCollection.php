<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskCollection extends BaseCollection
{
    public $collects = TaskResource::class;

    public function toArray(Request $request): array
    {
        return [
            'count' => $this->count(),
            Task::type() => $this->collection,
        ];
    }
}
