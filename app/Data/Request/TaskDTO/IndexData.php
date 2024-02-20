<?php

declare(strict_types=1);

namespace App\Data\Request\TaskDTO;

use App\Data\Request\RequestDataInterface;
use App\Enums\FilterEnum;
use App\Enums\SortEnum;
use Illuminate\Support\Collection;

class IndexData implements RequestDataInterface
{
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

    public static function fromArray(array $data = []): self
    {
        return new self(
            status: data_get($data, 'status'),
            priority: data_get($data, 'priority'),
            title: data_get($data, 'title'),
            prioritySort: data_get($data, 'prioritySort'),
            createdSort: data_get($data, 'createdSort'),
            completedSort: data_get($data, 'completedSort'),
        );
    }

    public function hasSort(): bool
    {
        return isset($this->prioritySort)
            || isset($this->createdSort)
            || isset($this->completedSort);
    }

    public function hasFilter(): bool
    {
        return isset($this->status)
            || isset($this->priority);
    }

    public function hasTxtFilter(): bool
    {
        return isset($this->title);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

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

    public function getSort(): Collection
    {
        return $this->getData()->only(SortEnum::toArray());
    }

    public function getFilter(): Collection
    {
        return $this->getData()->only(FilterEnum::nameToArray());
    }
}
