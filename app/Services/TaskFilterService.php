<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class TaskFilterService
{

    const FILTER = [
        'status' => '=',
        'priority' => '>=',
    ];

    /**
     * @param object $data
     * @return array
     */
    public function getFilter(object $data): array
    {
        $where[] = ['user_id', '=', (string)Auth::id()];

        foreach (self::FILTER as $field => $action) {
            if (isset($data->{$field})) {
                $value = $data->{$field};
                $where[] = [$field, $action, $value];
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
