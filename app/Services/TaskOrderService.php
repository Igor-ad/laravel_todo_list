<?php

namespace App\Services;

use App\Http\Requests\Api\TaskIndexRequest;

class TaskOrderService
{

    /**
     * @param TaskIndexRequest $request
     * @return array|null
     */
    public function orderDirection(TaskIndexRequest $request): ?array
    {
        $orderDirection = null;

        if ($request->has('prioritySort')) {
            $orderDirection[] = 'priority ' . $request->input('prioritySort');
        }
        if ($request->has('createdSort')) {
            $orderDirection[] = 'created_at ' . $request->input('createdSort');
        }
        if ($request->has('completedSort')) {
            $orderDirection[] = 'completed_at ' . $request->input('completedSort');
        }
        return $orderDirection;
    }

    /**
     * @param TaskIndexRequest $request
     * @return string
     */
    public function orderExpression(TaskIndexRequest $request): string
    {
        return implode(', ', $this->orderDirection($request));
    }

}
