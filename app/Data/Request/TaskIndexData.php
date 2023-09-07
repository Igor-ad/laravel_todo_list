<?php

namespace App\Data\Request;

use Illuminate\Support\Collection;

class TaskIndexData implements RequestDataInterface
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
     * @return Collection
     */
    public function getData(): Collection
    {
        return collect([
            'status' => $this->status,
            'priority' => $this->priority,
            'prioritySort' => $this->prioritySort,
            'createdSort' => $this->createdSort,
            'completedSort' => $this->completedSort,
        ])->whereNotNull();
    }

    /**
     * @return Collection
     */
    public function getSort(): Collection
    {
        return $this->getData()->only([
            'prioritySort',
            'createdSort',
            'completedSort'
        ]);
    }

    /**
     * @return Collection
     */
    public function getFilter(): Collection
    {
        return $this->getData()->only([
            'status',
            'priority'
        ]);
    }
}
