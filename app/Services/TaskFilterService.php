<?php

namespace App\Services;

use App\Data\TaskIndexData;
use App\Enums\FilterEnum;

class TaskFilterService
{

    /**
     * @param TaskIndexData $data
     * @return array
     */
    public function getFilter(TaskIndexData $data): array
    {
        $where = [];

        foreach (FilterEnum::cases() as $case) {
            if (isset($data->{$case->name})) {
                $value = $data->{$case->name};
                $where[] = [$case->name, $case->value, $value];
            }
        }
        return $where;
    }

    /**
     * @param TaskIndexData $data
     * @return string
     */
    public function matchAgainstFilter(TaskIndexData $data): string
    {
        $value = $data->title;

        return "MATCH (`title`) AGAINST ('$value')";
    }

}
