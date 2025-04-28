<?php

declare(strict_types=1);

namespace App\Data\Request\TaskDTO;

use App\Data\Request\RequestDataInterface;
use Illuminate\Support\Collection;

class UpdateData implements RequestDataInterface
{
    public function __construct(
        private readonly string $status,
        private readonly int    $priority,
        private readonly string $title,
        private readonly string $description,
        private readonly ?int   $parent_id,
    ) {
    }

    public function getData(): Collection
    {
        return collect([
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
