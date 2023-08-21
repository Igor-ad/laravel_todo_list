<?php

namespace App\Data;


class TaskIndexData
{
    /**
     * @param string|null $status
     * @param int|null $priority
     * @param string|null $title
     * @param string|null $prioritySort
     * @param string|null $createdSort
     * @param string|null $completedSort
     */
    public function __construct(
        public readonly ?string $status = null,
        public readonly ?int    $priority = null,
        public readonly ?string $title = null,
        public readonly ?string $prioritySort = null,
        public readonly ?string $createdSort = null,
        public readonly ?string $completedSort = null,
    )
    {
    }

    /**
     * @return bool
     */
    public function hasSort(): bool
    {
        return isset($this->prioritySort)
            || isset($this->createdSort)
            || isset($this->completedSort);
    }

    /**
     * @return bool
     */
    public function hasFilter(): bool
    {
        return isset($this->status)
            || isset($this->priority);
    }

    /**
     * @return bool
     */
    public function hasTxtFilter(): bool
    {
        return isset($this->title);
    }
}
