<?php

namespace App\Http\Controllers\Web;

use App\Enums\TaskPathEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\UpdateService;
use Illuminate\Http\RedirectResponse;

class TaskUpdateController extends Controller
{
    use ServiceMapper;

    /**
     * @param UpdateService $taskService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected UpdateService $taskService,
        protected AnswerService $answerService,
    )
    {
    }

    public function update(int $id): RedirectResponse
    {

        $this->answerService = $this->getAnswer($this->taskService, 'update');

        return redirect(TaskPathEnum::show->value . $id);
    }
}
