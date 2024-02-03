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
        $this->answerService->setAnswer(Show::showWithParents($id));

        $title = __('task.web.show_');
        $help = __('task.show', ['id' => $id]);
        $task = $this->answerService->answerData->getData();

        $this->answerService->setAnswer(Show::getRelationId($task, 'parents'));
        $relationId = $this->answerService->answerData->getData();

        $this->answerService->setAnswer(Show::getChildrenId($task, 'children'));
        $childrenId = $this->answerService->answerData->getData();

        return view('tasks.task_show', compact(
            'task', 'relationId', 'childrenId', 'help', 'title'
        ));
    }
}
