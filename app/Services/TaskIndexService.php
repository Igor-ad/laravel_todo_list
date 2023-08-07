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
            $tasks = $this->orderTasks();

        } elseif (!$this->request->hasAny(self::SORT_KEY)
            && ($this->request->has('title'))) {
            $tasks = $this->filterTasks();

        } elseif ($this->request->hasAny(self::SORT_KEY)
            && ($this->request->has('title'))) {
            $tasks = $this->orderFilterTasks();

        } else {
            $tasks = $this->tasks();
        }

        return $tasks;
    }

    /**
     * @return Collection
     */
    private function tasks()
    {
        return $this->taskRepo->getUserTasks();
    }

    /**
     * @return Collection
     */
    private function orderTasks()
    {
        return $this->taskRepo->getOrderUserTasks();
    }

    /**
     * @return Collection
     */
    private function filterTasks()
    {
        return $this->taskRepo->getAllFilterUserTasks();
    }

    /**
     * @return Collection
     */
    private function orderFilterTasks()
    {
        return $this->taskRepo->getOrderAllFilterUserTasks();
    }
}
