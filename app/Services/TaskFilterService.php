<?php

namespace App\Services;

use App\Data\Request\TaskIndexData;
use App\Enums\FilterEnum;

class TaskFilterService
{
    private array $where = [];

    /**
     * @param TaskIndexData $data
     * @return array
     */
    public function filter(TaskIndexData $data): array
    {
        foreach (FilterEnum::cases() as $case) {
            if (isset($data->getFilter()[$case->name])) {
                $value = $data->getFilter()[$case->name];
                $this->where[] = [$case->name, $case->value, $value];
            }
        }
        return $this->where;
    }

    /**
     * @return string
     */
    public function fullTextFilter(): string
    {
        return 'MATCH (`title`) AGAINST (+? IN BOOLEAN MODE)';
    }
}
