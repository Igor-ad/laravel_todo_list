<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\TaskDTO\UpdateData;
use App\Exceptions\Task\ServiceException;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\CommonService;

class UpdateService extends CommonService
{
    public function __construct(
        protected TaskRepository    $task,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function update(int $id, UpdateData $data): Task
    {
        if ($this->task->updateById($id, $data)) {
            return $this->task->getById($id);
        }
        throw new ServiceException(__('task.update_fail', ['id' => $id]));
    }
}
