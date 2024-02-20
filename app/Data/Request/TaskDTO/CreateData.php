<?php

declare(strict_types=1);

namespace App\Data\Request\TaskDTO;

use App\Data\Request\RequestDataInterface;
use Illuminate\Support\Collection;

class CreateData implements RequestDataInterface
{
    public function __construct(
        private readonly string $status,
        private readonly int    $priority,
        private readonly string $title,
        private readonly string $description,
        private readonly ?int   $parent_id = null,

    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            status: data_get($data, 'status'),
            priority: (int)data_get($data, 'priority'),
            title: data_get($data, 'title'),
            description: data_get($data, 'description'),
            parent_id: (int)data_get($data, 'parent_id'),
        );
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
