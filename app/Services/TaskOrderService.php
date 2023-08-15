<?php

namespace App\Services;

use App\Enums\SortOrderEnum;
use App\Enums\SortEnum;

class TaskOrderService
{

    /**
     * @param object $data
     * @return array|null
     */
    private function orderDirection(object $data): ?array
    {
        $orderDirection = null;

        foreach (SortEnum::cases() as $case) {
            if (isset($data->{$case->value})) {
                $direction = SortOrderEnum::from($data->{$case->value})->name;
                $orderDirection[] = $this->orderString($case->name, $direction);
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
