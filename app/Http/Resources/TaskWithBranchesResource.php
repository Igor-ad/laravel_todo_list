<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class TaskWithBranchesResource extends TaskResource
{
    public function toArray(Request $request): array
    {
        $resource = parent::toArray($request);
        $resource['branches'] = $this->branches;

        return $resource;
    }
}
