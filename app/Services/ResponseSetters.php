<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as Collect;
use Symfony\Component\HttpFoundation\Response;

trait ResponseSetters
{
    public function setIndexData(Collection $data): void
    {
        $this->setResponseData(
            message: __('task.index'),
            data: $data,
        );
    }

    public function setCompleteData(int $id, int $data): void
    {
        $this->setResponseData(
            message: __('task.web.empty', ['id' => $id]),
            data: $data,
        );
    }

    public function setShowData(int $id, null|Collect|Task $data): void
    {
        $this->setResponseData(
            message: __('task.show', ['id' => $id]),
            data: $data,
        );
    }

    public function setUpdateData(bool|Task $data): void
    {
        $this->setResponseData(
            message: __('task.update'),
            data: $data,
        );
    }

    public function setCreateData(bool|Task $data): void
    {
        $this->setResponseData(
            message: __('task.create'),
            data: $data,
            status: Response::HTTP_CREATED,
        );
    }

    public function setDeleteData(int $id): void
    {
        $this->setResponseData(
            message: __('task.delete_success', ['id' => $id]),
            data: 1,
        );
    }
}
