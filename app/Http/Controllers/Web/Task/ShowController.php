<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 *  @todo Добавить кнопку на страницу для создания подзадачи - "Sub task".
 *  @todo При переходе на страницу создания новой задачи 'parent_id' будет уcтановлен от 'id' текущей задачи.
 */
class ShowController extends AbstractController
{
    public function show(int $id): View|RedirectResponse
    {
        $data = $this->answer->setAnswer(Show::showWithParents($id))->getData();
        $dataParents = $this->answer
            ->setAnswer(Show::getRelationIdStatus($data, 'parents'))->getData();
        $dataChildren = $this->answer
            ->setAnswer(Show::getChildrenIdStatus($data, 'children'))->getData();

        $viewData = collect();
        $viewData->put('title', __('task.web.show_'));
        $viewData->put('help', __('task.show', ['id' => $id]));
        $viewData->put('task', $data);
        $viewData->put('relationId', $dataParents);
        $viewData->put('childrenId', $dataChildren);

        return view('tasks.task_show', compact('viewData'));
    }
}
