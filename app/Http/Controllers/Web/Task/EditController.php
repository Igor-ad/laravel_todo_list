<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\ShowService;
use Illuminate\View\View;

class EditController
{
    use ServiceMapper;


    public function __construct(
        protected ShowService   $showService,
        protected AnswerService $answerService,
    )
    {
    }

    public function edit(int $id): View
    {
        $this->answerService = $this->getAnswer($this->showService, 'show', $id);

        $title = __('task.web.edit');
        $help = __('task.show', ['id' => $id]);
        $task = $this->answerService->answerData->getPropData();

        return view('tasks.task_edit', compact('task', 'help', 'title'));
    }
}
