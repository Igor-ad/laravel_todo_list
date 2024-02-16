<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\TaskDTO\IndexData;
use App\Enums\SortOrderEnum;
use App\Enums\SortEnum;
use App\Services\CommonService;

class OrderService extends CommonService
{
    private array $orderDirection = [];

    private function orderDirection(IndexData $data): ?array
    {
        foreach ($data->getSort() as $key => $value) {
            $this->orderDirection[] = $this->orderString(
                SortEnum::from($key)->name,
                SortOrderEnum::from($value)->name,
            );
        }
        return $this->orderDirection;
    }

    private function orderString(string $key, string $direction): string
    {
        return $key . ' ' . $direction;
    }

    public function orderExpression(IndexData $data): string
    {
        return implode(', ', $this->orderDirection($data));
    }
}
