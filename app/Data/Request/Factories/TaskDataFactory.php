<?php

declare(strict_types=1);

namespace App\Data\Request\Factories;

use App\Data\Request\TaskIndexData;
use App\Http\Requests\Api\TaskIndexRequest;

class TaskDataFactory implements RequestDataFactoryInterface
{
    public function __construct(
        protected TaskIndexRequest $request,
    )
    {
    }

    public function getValidData(): TaskIndexData
    {
        return new TaskIndexData(...$this->request->validated());
    }
}
