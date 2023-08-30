<?php

namespace App\Services;

use App\Data\TaskIndexData;
use App\Enums\FilterEnum;

class TaskFilterService
{
    private array $where = [];

    /**
     * @param TaskIndexData $data
     * @return array
     */
    public function getFilter(TaskIndexData $data): array
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
     * @param TaskIndexData $data
     * @return string
     */
    public function fullTextFilter(TaskIndexData $data): string
    {
        $value = $data->getTitle();

        return "MATCH (`title`) AGAINST ('$value')";
    }
}
