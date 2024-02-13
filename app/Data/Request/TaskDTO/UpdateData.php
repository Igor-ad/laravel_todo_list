<?php

declare(strict_types=1);

namespace App\Data\Request\TaskDTO;

use App\Data\Request\RequestDataInterface;
use Illuminate\Support\Collection;

class UpdateData implements RequestDataInterface
{
    public function __construct(
        private readonly int     $id,
        private readonly ?int    $parent_id = null,
        private readonly ?string $status = null,
        private readonly ?int    $priority = null,
        private readonly ?string $title = null,
        private readonly ?string $description = null,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): Collection
    {
        return collect([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
        ])->whereNotNull();
    }
}
