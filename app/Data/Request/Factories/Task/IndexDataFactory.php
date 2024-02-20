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
    )
    {
    }

    public function getValidData(): IndexData
    {
        return IndexData::fromArray($this->request->validated());
    }
}
