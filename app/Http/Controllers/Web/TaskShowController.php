<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\ShowService;
use Illuminate\View\View;

class TaskShowController extends Controller
{
    use ServiceMapper;

    /**
     * @param ShowService $showService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected ShowService   $showService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $this->answerService = $this->getAnswer($this->showService, 'show', $id);

        $title = __('task.web.show_');
        $help = __('task.show', ['id' => $id]);
        $task = $this->answerService->answerData->getPropData();

        return view('tasks.task_show', compact('task', 'help', 'title'));
    }
}
