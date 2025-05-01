<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class TaskWithParentResource extends TaskResource
{
    public function toArray(Request $request): array
    {
        $resource = parent::toArray($request);
        $resource['parent'] = $this->parent;

        return $resource;
    }
}
