<?php

namespace App\Services;

class TaskOrderService
{

    const ORDER = [
        'priority' => 'prioritySort',
        'created_at' => 'createdSort',
        'completed_at' => 'completedSort',
    ];

    /**
     * @param object $data
     * @return array|null
     */
    private function orderDirection(object $data): ?array
    {
        $orderDirection = null;

        foreach (self::ORDER as $key => $property) {
            if (isset($data->{$property})) {
                $direction = $data->{$property};
                $orderDirection[] = $this->orderString($key, $direction);
            }
        }
        return $orderDirection;
    }

    /**
     * @param string $key
     * @param string $direction
     * @return string
     */
    private function orderString(string $key, string $direction): string
    {
        return $key . ' ' . $direction;
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
