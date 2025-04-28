<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => Str::words($this->description, 3),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'completed_at' => $this->completed_at,
        ];
    }
}
