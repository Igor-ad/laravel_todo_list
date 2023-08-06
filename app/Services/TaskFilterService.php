<?php

namespace App\Services;


use App\Http\Requests\Api\TaskIndexRequest;
use Illuminate\Support\Facades\Auth;

class TaskFilterService
{

    /**
     * @param TaskIndexRequest $request
     */
    public function __construct(TaskIndexRequest $request)
    {
    }

    /**
     * @param TaskIndexRequest $request
     * @return array
     */
    public function getFilter(TaskIndexRequest $request): array
    {
        $userId = Auth::id();
        $where['user_id'] = " $userId";

        if ($request->has('status')) {
            $where['status'] = $request->input('status');
        }
        if ($request->has('priority')) {
            $where[] = ['priority', '>=', $request->input('priority')];
        }
        return $where;
    }

    /**
     * @param TaskIndexRequest $request
     * @return string
     */
    public function matchAgainstFilter(TaskIndexRequest $request): string
    {
        $value = $request->input('title');

        return "MATCH (`title`) AGAINST ('$value')";
    }

}
