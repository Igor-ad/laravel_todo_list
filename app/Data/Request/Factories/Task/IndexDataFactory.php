<?php

declare(strict_types=1);

namespace App\Data\Request\Factories\Task;

use App\Data\Request\Factories\RequestDataFactoryInterface;
use App\Data\Request\TaskDTO\IndexData;
use App\Http\Requests\Task\IndexRequest;

class IndexDataFactory implements RequestDataFactoryInterface
{
    public function __construct(
        protected IndexRequest $request,
    ) {
    }

    public function getValidData(): IndexData
    {
        $data = $this->request->validated();

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
