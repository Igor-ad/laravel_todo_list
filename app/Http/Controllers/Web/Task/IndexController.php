<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Index as Indexer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\View\View;

class IndexController extends Controller
{
    use ServiceMapper;

    public function index(): View
    {
        $this->answerService->setAnswer(Indexer::index());

        $title = __('task.web.index');
        $help = $this->answerService->answerData->getMessage();
        $tasks = $this->answerService->answerData->getPropData();

        return view('tasks.tasks', compact('tasks', 'help', 'title'));
    }
}
