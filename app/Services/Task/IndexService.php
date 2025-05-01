<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Data\Request\TaskDTO\IndexData;
use App\Exceptions\Task\ServiceException;
use App\Http\Resources\TaskCollectionResource;
use App\Repositories\TaskRepository;
use App\Services\CommonService;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexService extends CommonService
{
    public function __construct(
        protected TaskRepository $task,
    ) {
    }

    /**
     * @throws ServiceException
     */
    public function index(IndexData $data): ResourceCollection
    {
        $taskData = match (true) {
            $data->hasSort() && !$data->hasTxtFilter() => $this->task->getOrder($data),
            !$data->hasSort() && $data->hasTxtFilter() => $this->task->getAllFilter($data),
            $data->hasSort() && $data->hasTxtFilter() => $this->task->getOrderAllFilter($data),
            default => $this->task->get($data),
        };

        if (($taskData->isEmpty())) {
            throw new ServiceException(__('task.index_filter_fail'),);
        }

        return TaskCollectionResource::make($taskData);
    }
}
