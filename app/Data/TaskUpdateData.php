<?php

namespace App\Data;

class TaskUpdateData
{
    /**
     * @param int $id
     * @param int|null $parent_id
     * @param string|null $status
     * @param int|null $priority
     * @param string|null $title
     * @param string|null $description
     */
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return array_diff([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
        ], [null]);
    }
}
