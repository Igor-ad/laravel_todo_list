<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

trait ResponseSetters
{
    /**
     * @param Collection $data
     * @return void
     */
    public function setTaskIndexData(Collection $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.index'),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @param bool $data
     * @return void
     */
    public function setTaskCompleteData(int $id, bool $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.complete', ['id' => $id]),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @param Task|null $data
     * @return void
     */
    public function setTaskShowData(int $id, ?Task $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.show', ['id' => $id]),
            data: $data,
        );
    }

    /**
     * @param bool|Task $data
     * @return void
     */
    public function setTaskUpdateData(bool|Task $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.update'),
            data: $data,
        );
    }

    /**
     * @param bool|Task $data
     * @return void
     */
    public function setTaskCreateData(bool|Task $data): void
    {
        $this->setResponseData(
            status: Response::HTTP_CREATED,
            message: __('task.create'),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @return void
     */
    public function setTaskDeleteData(int $id): void
    {
        $this->setResponseData(
            status: Response::HTTP_OK,
            message: __('task.delete_success', ['id' => $id]),
            data: true,
        );
    }
}
