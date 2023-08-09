<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskIndexService;
use App\Services\TaskMarkedDoneService;
use App\Services\TaskService;

class TaskHelper extends Controller
{

    /**
     * @param TaskService $taskService
     * @param TaskIndexService $taskIndexService
     * @param TaskMarkedDoneService $markedDoneService
     * @param object $ans
     */
    public function __construct(
        protected TaskService           $taskService,
        protected TaskIndexService      $taskIndexService,
        protected TaskMarkedDoneService $markedDoneService,
        protected object                $ans = new \stdClass,
    )
    {
    }

}
