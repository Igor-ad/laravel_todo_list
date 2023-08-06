<?php

namespace App\Repositories;

use App\Http\Requests\Api\TaskIndexRequest;
use App\Models\Task;
use App\Services\TaskFilterService;
use App\Services\TaskOrderService;
use Illuminate\Database\Eloquent\Collection;

class TaskIndexRepository
{

    /**
     * @param TaskFilterService $filter
     * @param TaskOrderService $order
     * @param TaskIndexRequest $request
     */
    public function __construct(
        protected TaskFilterService $filter,
        protected TaskOrderService  $order,
        protected TaskIndexRequest  $request,
    )
    {
    }

    /**
     * @return Collection
     */
    public function getUserTasks(): Collection
    {
        return Task::where($this->filter->getFilter($this->request))
            ->get();
    }

    /**
     * @return Collection
     */
    public function getOrderUserTasks(): Collection
    {
        return Task::where($this->filter->getFilter($this->request))
            ->orderByRaw($this->order->orderExpression($this->request))
            ->get();
    }

    /**
     * @return Collection
     */
    public function getAllFilterUserTasks(): Collection
    {
        return Task::where($this->filter->getFilter($this->request))
            ->whereRaw($this->filter->matchAgainstFilter($this->request))
            ->get();
    }

    /**
     * @return Collection
     */
    public function getOrderAllFilterUserTasks(): Collection
    {
        return Task::where($this->filter->getFilter($this->request))
            ->whereRaw($this->filter->matchAgainstFilter($this->request))
            ->orderByRaw($this->order->orderExpression($this->request))
            ->get();
    }

}
