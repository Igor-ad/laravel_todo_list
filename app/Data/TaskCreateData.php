<?php

namespace App\Data;

class TaskCreateData
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
     * @return array
     */
    public function getData(): array
    {
        return [
            'user_id' => $this->user_id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
