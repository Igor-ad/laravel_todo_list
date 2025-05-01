<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class TaskWithChildrenResource extends TaskResource
{
    public function toArray(Request $request): array
    {
        $resource = parent::toArray($request);
        $resource['children'] = $this->children;

        return $resource;
    }
}
