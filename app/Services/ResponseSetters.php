<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

trait ResponseSetters
{
    public function setIndexData(Collection $data): self
    {
        return $this->setResponseData(
            message: __('task.index'),
            data: $data,
        );
    }

    public function setCompleteData(int $id, int $data): self
    {
        return $this->setResponseData(
            message: __('task.web.empty', ['id' => $id]),
            data: $data,
        );
    }

    public function setShowData(int $id, mixed $data): self
    {
        return $this->setResponseData(
            message: __('task.show', ['id' => $id]),
            data: $data,
        );
    }

    public function setUpdateData(bool|Task $data): self
    {
        return $this->setResponseData(
            message: __('task.update'),
            data: $data,
        );
    }

    public function setCreateData(bool|Task $data): self
    {
        return $this->setResponseData(
            message: __('task.create'),
            data: $data,
            status: Response::HTTP_CREATED,
        );
    }

    public function setDeleteData(int $id): self
    {
        return $this->setResponseData(
            message: __('task.delete_success', ['id' => $id]),
            data: 1,
        );
    }
}
