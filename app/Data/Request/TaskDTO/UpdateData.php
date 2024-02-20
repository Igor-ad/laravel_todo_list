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

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int)data_get($data, 'id'),
            parent_id: (int)data_get($data, 'parent_id'),
            status: data_get($data, 'status'),
            priority: (int)data_get($data, 'priority'),
            title: data_get($data, 'title'),
            description: data_get($data, 'description'),
        );
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
