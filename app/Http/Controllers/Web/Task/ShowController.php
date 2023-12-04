<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\View\View;

class ShowController extends Controller
{
    use ServiceMapper;

    public function show(int $id): View
    {
        $this->answerService->setAnswer(Show::show($id));

        $title = __('task.web.show_');
        $help = __('task.show', ['id' => $id]);
        $task = $this->answerService->answerData->getPropData();

        return view('tasks.task_show', compact('task', 'help', 'title'));
    }
}
