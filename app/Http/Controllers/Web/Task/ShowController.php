<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShowController extends Controller
{
    use ServiceMapper;

    public function show(int $id): View|RedirectResponse
    {
        $this->answer()->setAnswer(Show::showWithParents($id));

        $viewData = collect();
        $viewData->put('title', __('task.web.show_'));
        $viewData->put('help', __('task.show', ['id' => $id]));
        $viewData->put('task', $this->serviceLayerData());

        $this->answer()->setAnswer(Show::getRelationId($viewData['task'], 'parents'));
        $viewData->put('relationId', $this->serviceLayerData());

        $this->answer()->setAnswer(Show::getChildrenIdStatus($viewData['task'], 'children'));
        $viewData->put('childrenId', $this->serviceLayerData());

        return view('tasks.task_show', compact('viewData'));
    }
}
