<?php

namespace App\Data\Request;

use Illuminate\Support\Collection;

class TaskCreateData implements RequestDataInterface
{
    /**
     * @param int $user_id
     * @param string $status
     * @param int $priority
     * @param string $title
     * @param string $description
     * @param int|null $parent_id
     */
    public function __construct(
        private readonly int    $user_id,
        private readonly string $status,
        private readonly int    $priority,
        private readonly string $title,
        private readonly string $description,
        private readonly ?int   $parent_id = null,

    )
    {
    }

    /**
     * @return Collection
     */
    public function getData(): Collection
    {
        return collect([
            'user_id' => $this->user_id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
