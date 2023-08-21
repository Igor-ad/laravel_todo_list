<?php

namespace App\Services;

use App\Data\TaskIndexData;
use App\Enums\FilterEnum;
use Illuminate\Support\Facades\Auth;

class TaskFilterService
{

    /**
     * @param TaskIndexData $data
     * @return array
     */
    public function getFilter(TaskIndexData $data): array
    {
        if (!$data->hasFilter()) {
            return [$this->userFilter()];
        }
        return [$this->userFilter(), $this->rowFilter($data)];
    }

    /**
     * @param TaskIndexData $data
     * @return array
     */
    protected function rowFilter(TaskIndexData $data): array
    {
        $where = [];

        foreach (FilterEnum::cases() as $case) {
            if (isset($data->{$case->name})) {
                $value = $data->{$case->name};
                $where[] = [$case->name, $case->value, $value];
            }
        }
        return [$where];
    }

    /**
     * @return array
     */
    protected function userFilter(): array
    {
        return ['user_id', '=', Auth::id()];

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

    /**
     * @param int $id
     * @return array[]
     */
    public function getFilterParam(int $id): array
    {
        return [
            ['id', '=', $id],
            $this->userFilter(),
        ];
    }

}
