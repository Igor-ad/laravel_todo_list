<?php

namespace App\Services;

use App\Enums\OrderDirectionEnum;
use App\Enums\OrderEnum;

class TaskOrderService
{

    /**
     * @param object $data
     * @return array|null
     */
    private function orderDirection(object $data): ?array
    {
        $orderDirection = null;

        foreach (OrderEnum::cases() as $case) {
            if (isset($data->{$case->value})) {
                $direction = $this->orderSqlDirection($data->{$case->value});
                $orderDirection[] = $this->orderString($case->name, $direction);
            }
        }
        return $orderDirection;
    }

    /**
     * @param string $direction
     * @return string
     */
    private function orderSqlDirection(string $direction): string
    {
        foreach (OrderDirectionEnum::cases() as $case) {
            if ($case->value === $direction) {

                return $case->name;
            }
        }
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
