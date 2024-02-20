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
    )
    {
    }

    public function getValidData(): UpdateData
    {
        return UpdateData::fromArray($this->request->validated());
    }
}
