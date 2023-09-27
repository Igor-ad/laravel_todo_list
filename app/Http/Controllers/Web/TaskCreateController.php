<?php

namespace App\Http\Controllers\Web;

use App\Enums\TaskPathEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CreateService;
use Illuminate\Http\RedirectResponse;

class TaskCreateController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected CreateService $taskService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        $this->answerService = $this->getAnswer($this->taskService, 'create');

        return redirect(TaskPathEnum::index->value);
    }
}
