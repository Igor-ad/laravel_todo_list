<?php

declare(strict_types=1);

namespace App\Data\Request\Factories\Task;

use App\Data\Request\TaskDTO\IndexData;

class IndexDataFactory extends AbstractDataFactory
{
    protected function getValidData(array $data): IndexData
    {
        return new IndexData(
            status: data_get($data, 'status'),
            priority: (int)data_get($data, 'priority'),
            title: data_get($data, 'title'),
            prioritySort: data_get($data, 'prioritySort'),
            createdSort: data_get($data, 'createdSort'),
            completedSort: data_get($data, 'completedSort'),
        );
    }
}
