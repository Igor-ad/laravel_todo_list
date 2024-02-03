<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\ServiceMapper;
use Illuminate\View\View;

class EditController
{
    use ServiceMapper;

    public function edit(int $id): View
    {
        $this->answerService->setAnswer(Show::show($id));

        $title = __('task.web.edit');
        $help = __('task.show', ['id' => $id]);
        $task = $this->answerService->answerData->getData();

        return view('tasks.task_edit', compact('task', 'help', 'title'));
    }
}
