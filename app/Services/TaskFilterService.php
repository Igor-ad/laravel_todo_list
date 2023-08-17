<?php

namespace App\Services;

use App\Enums\FilterEnum;
use Illuminate\Support\Facades\Auth;

class TaskFilterService
{

    /**
     * @param object $data
     * @return array
     */
    public function getFilter(object $data): array
    {
        $where[] = ['user_id', '=', (string)Auth::id()];

        foreach (FilterEnum::cases() as $case) {
            if (isset($data->{$case->name})) {
                $value = $data->{$case->name};
                $where[] = [$case->name, $case->value, $value];
            }
        }
        return $where;
    }

    /**
     * @param object $data
     * @return string
     */
    public function matchAgainstFilter(object $data): string
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
            ['user_id', '=', Auth::id()],
        ];
    }

}
