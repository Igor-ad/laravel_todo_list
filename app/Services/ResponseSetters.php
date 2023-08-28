<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

trait ResponseSetters
{
    /**
     * @param Collection $data
     * @return void
     */
    public function setTaskIndexData(Collection $data): void
    {
        $this->setResponseData(
            status: 200,
            message: __('task.index'),
            data: $data,
        );
    }

    /**
     * @param Collection|null $data
     * @return void
     */
    public function setTaskIndexFailData(?Collection $data): void
    {
        $this->setResponseData(
            status: 500,
            message: __('task.index_filter_fail'),
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
            status: 200,
            message: __('task.market_done', ['id' => $id]),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @return void
     */
    public function setTaskCompleteFailData(int $id): void
    {
        $this->setResponseData(
            status: 501,
            message: __('task.market_done_fail', ['id' => $id]),
            data: false,
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
            status: 200,
            message: __('task.show', ['id' => $id]),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @param Task|null $data
     * @return void
     */
    public function setTaskShowFailData(int $id, ?Task $data): void
    {
        $this->setResponseData(
            status: 501,
            message: __('task.not_found', ['id' => $id]),
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
            status: 200,
            message: __('task.update'),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @return void
     */
    public function setTaskUpdateFailData(int $id): void
    {
        $this->setResponseData(
            status: 406,
            message: __('task.not_found', ['id' => $id]),
            data: 0,
        );
    }

    /**
     * @param bool|Task $data
     * @return void
     */
    public function setTaskCreateData(bool|Task $data): void
    {
        $this->setResponseData(
            status: 201,
            message: __('task.create'),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @param bool $data
     * @return void
     */
    public function setTaskDeleteData(int $id, bool $data): void
    {
        $this->setResponseData(
            status: 200,
            message: __('task.delete_success', ['id' => $id]),
            data: $data,
        );
    }

    /**
     * @param int $id
     * @param Task|null $data
     * @return void
     */
    public function setTaskDeleteFailData(int $id, ?Task $data): void
    {
        $this->setResponseData(
            status: 501,
            message: __('task.delete_fail', ['id' => $id]),
            data: $data,
        );
    }
}
