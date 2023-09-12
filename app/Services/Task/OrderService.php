<?php

namespace App\Services\Task;

use App\Data\Request\TaskIndexData;
use App\Enums\SortOrderEnum;
use App\Enums\SortEnum;

class OrderService
{

    private array $orderDirection = [];

    /**
     * @param TaskIndexData $data
     * @return array|null
     */
    private function orderDirection(TaskIndexData $data): ?array
    {
        foreach ($data->getSort() as $key => $value) {
            $this->orderDirection[] = $this->orderString(
                SortEnum::from($key)->name,
                SortOrderEnum::from($value)->name,
            );
        }
        return $this->orderDirection;
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
     * @param TaskIndexData $data
     * @return string
     */
    public function orderExpression(TaskIndexData $data): string
    {
        return implode(', ', $this->orderDirection($data));
    }

}
