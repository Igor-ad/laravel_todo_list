<?php

namespace App\Data;

class TaskUpsertData
{
    /**
     * @param int|null $id
     * @param int|null $user_id
     * @param int|null $parent_id
     * @param string|null $status
     * @param int|null $priority
     * @param string|null $title
     * @param string|null $description
     */
    public function __construct(
        public ?int    $id = null,
        public ?int    $user_id = null,
        public ?int    $parent_id = null,
        public ?string $status = null,
        public ?int    $priority = null,
        public ?string $title = null,
        public ?string $description = null,
    )
    {
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return array_diff([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
        ], [null]);
    }
}
