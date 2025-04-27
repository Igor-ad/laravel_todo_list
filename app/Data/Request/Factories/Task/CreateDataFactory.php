<?php

declare(strict_types=1);

namespace App\Data\Request\Factories\Task;

use App\Data\Request\Factories\RequestDataFactoryInterface;
use App\Data\Request\TaskDTO\CreateData;
use App\Http\Requests\Task\CreateRequest;

class CreateDataFactory implements RequestDataFactoryInterface
{
    public function __construct(
        protected CreateRequest $request,
    ) {
    }

    public function getValidData(): CreateData
    {
        $data = $this->request->validated();

        return new CreateData(
            status: data_get($data, 'status'),
            priority: (int)data_get($data, 'priority'),
            title: data_get($data, 'title'),
            description: data_get($data, 'description'),
            parent_id: (int)data_get($data, 'parent_id') ?: null,
        );
    }
}
