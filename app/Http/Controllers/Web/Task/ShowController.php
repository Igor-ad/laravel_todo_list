<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ShowController extends Controller
{
    public function show(int $id): View
    {
        $data = Show::showWithParents($id);
        $dataParents = Show::getRelationIdStatus($data, 'parents');
        $dataChildren = Show::getChildrenIdStatus($data, 'children');

        $viewData = collect()
            ->put('task', $data)
            ->put('title', __('task.web.show_'))
            ->put('help', __('task.show', ['id' => $id]))
            ->put('relationId', $dataParents)
            ->put('childrenId', $dataChildren);

        return view('tasks.task_show', compact('viewData'));
    }
}
