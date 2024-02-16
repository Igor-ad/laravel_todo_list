<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\TaskDTO\IndexData;
use App\Enums\FilterEnum;
use App\Services\CommonService;

class FilterService extends CommonService
{
    private array $where = [];

    public function filter(IndexData $data): array
    {
        foreach (FilterEnum::cases() as $case) {
            if (isset($data->getFilter()[$case->name])) {
                $value = $data->getFilter()[$case->name];
                $this->where[] = [$case->name, $case->value, $value];
            }
        }
        return $this->where;
    }

    public function fullTextFilter(): string
    {
        return 'MATCH (`title`, `description`) AGAINST (+? IN BOOLEAN MODE)';
    }
}
