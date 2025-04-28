<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\TaskDTO\CreateData;
use App\Exceptions\Task\ServiceException;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\CommonService;

class CreateService extends CommonService
{
    public function __construct(
        protected TaskRepository    $task,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function create(CreateData $data): Task
    {
        $result = $this->task->create($data);

        if (!$result) {
            throw new ServiceException(__('task.create_fail'));
        }

        return $result;
    }
}
