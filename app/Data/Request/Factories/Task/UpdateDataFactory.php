<?php

declare(strict_types=1);

namespace App\Data\Request\Factories\Task;

use App\Data\Request\Factories\RequestDataFactoryInterface;
use App\Data\Request\TaskDTO\UpdateData;
use App\Http\Requests\Task\UpdateRequest;

class UpdateDataFactory implements RequestDataFactoryInterface
{
    public function __construct(
        protected UpdateRequest $request,
    ) {
    }

    public function getValidData(): UpdateData
    {
        $data = $this->request->validated();

        return new UpdateData(
            id: (int)data_get($data, 'id'),
            status: data_get($data, 'status'),
            priority: (int)data_get($data, 'priority'),
            title: data_get($data, 'title'),
            description: data_get($data, 'description'),
            parent_id: (int)data_get($data, 'parent_id') ?: null,
        );
    }
}
