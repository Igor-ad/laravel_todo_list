<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

trait ResponseSetters
{
    public function setIndexData(Collection $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.index'),
            data: $data,
        );
    }

    public function setCompleteData(int $id, int $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.web.empty', ['id' => $id]),
            data: $data,
        );
    }

    public function setShowData(int $id, ?Task $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.show', ['id' => $id]),
            data: $data,
        );
    }

    public function setUpdateData(bool|Task $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.update'),
            data: $data,
        );
    }

    public function setCreateData(bool|Task $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_CREATED,
            message: __('task.create'),
            data: $data,
        );
    }

    public function setDeleteData(int $id): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.delete_success', ['id' => $id]),
            data: 1,
        );
    }
}
