<?php

declare(strict_types=1);

namespace App\Data\Request\Factories\Task;

use App\Data\Request\TaskDTO\UpdateData;

class UpdateDataFactory extends AbstractDataFactory
{
    protected function getValidData(array $data): UpdateData
    {
        return new UpdateData(
            status: data_get($data, 'status'),
            priority: (int)data_get($data, 'priority'),
            title: data_get($data, 'title'),
            description: data_get($data, 'description'),
            parent_id: (int)data_get($data, 'parent_id') ?: null,
        );
    }
}
