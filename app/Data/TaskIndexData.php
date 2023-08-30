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
        private readonly ?string $status = null,
        private readonly ?int    $priority = null,
        private readonly ?string $title = null,
        private readonly ?string $prioritySort = null,
        private readonly ?string $createdSort = null,
        private readonly ?string $completedSort = null,
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

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getSort(): array
    {
        return array_diff([
            'prioritySort' => $this->prioritySort,
            'createdSort' => $this->createdSort,
            'completedSort' => $this->completedSort,
        ], [null]);
    }

    /**
     * @return array
     */
    public function getFilter(): array
    {
        return array_diff([
            'status' => $this->status,
            'priority' => $this->priority,
        ], [null]);
    }
}
