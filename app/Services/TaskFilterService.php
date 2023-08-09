<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;

class TaskFilterService
{

    /**
     * @param object $data
     * @return array
     */
    public function getFilter(object $data): array
    {
        $userId = (string)Auth::id();
        $where['user_id'] = " $userId";

        if (property_exists($data, 'status')) {
            $where['status'] = $data->status;
        }
        if (property_exists($data, 'priority')) {
            $where[] = ['priority', '>=', $data->priority];
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
