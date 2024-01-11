<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\TaskIndexData;
use App\Enums\FilterEnum;
use App\Services\AbstractService;

class FilterService extends AbstractService
{
    private array $where = [];

    public function filter(TaskIndexData $data): array
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
