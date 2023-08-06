<?php

namespace App\Services;

use App\Http\Requests\Api\TaskIndexRequest;
use App\Repositories\TaskIndexRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskIndexService
{

    public function __construct(
        protected TaskIndexRequest    $request,
        protected TaskIndexRepository $taskRepo,
    )
    {
    }

    const SORT_KEY = [
        'createdSort',
        'completedSort',
        'prioritySort',
    ];

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {

        if ($this->request->hasAny(self::SORT_KEY)
            && (!$this->request->has('title'))) {
            $tasks = $this->taskRepo->getOrderUserTasks();

        } elseif (!$this->request->hasAny(self::SORT_KEY)
            && ($this->request->has('title'))) {
            $tasks = $this->taskRepo->getAllFilterUserTasks();

        } elseif ($this->request->hasAny(self::SORT_KEY)
            && ($this->request->has('title'))) {
            $tasks = $this->taskRepo->getOrderAllFilterUserTasks();

        } else {
            $tasks = $this->taskRepo->getUserTasks();
        }

        return $tasks;
    }

}
