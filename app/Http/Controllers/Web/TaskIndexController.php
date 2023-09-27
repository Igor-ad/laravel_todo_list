<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\IndexService;
use Illuminate\View\View;

class TaskIndexController extends Controller
{
    use ServiceMapper;

    /**
     * @param IndexService $indexService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected IndexService  $indexService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $this->answerService = $this->getAnswer($this->indexService, 'index');

        $title = __('task.web.index');
        $help = $this->answerService->answerData->getMessage();
        $tasks = $this->answerService->answerData->getPropData();

        return view('tasks.tasks', compact('tasks', 'help', 'title'));
    }
}
