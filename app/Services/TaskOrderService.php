<?php

namespace App\Services;

class TaskOrderService
{

    /**
     * @param object $data
     * @return array|null
     */
    public function orderDirection(object $data): ?array
    {
        $orderDirection = null;

        if (property_exists($data, 'prioritySort')) {
            $orderDirection[] = 'priority ' . $data->prioritySort;
        }
        if (property_exists($data, 'createdSort')) {
            $orderDirection[] = 'created_at ' . $data->createdSort;
        }
        if (property_exists($data, 'completedSort')) {
            $orderDirection[] = 'completed_at ' . $data->completedSort;
        }
        return $orderDirection;
    }

    /**
     * @param object $data
     * @return string
     */
    public function orderExpression(object $data): string
    {
        return implode(', ', $this->orderDirection($data));
    }

}
