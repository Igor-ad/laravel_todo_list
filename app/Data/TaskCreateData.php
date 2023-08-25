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
        public readonly int    $user_id,
        public readonly string $status,
        public readonly int    $priority,
        public readonly string $title,
        public readonly string $description,
        public readonly ?int   $parent_id = null,

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
