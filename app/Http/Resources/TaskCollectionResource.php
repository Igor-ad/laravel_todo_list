<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollectionResource extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->toArray();
    }
}
