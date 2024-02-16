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
        $this->answer()->setAnswer(Show::show($id));

        $viewData = collect();
        $viewData->put('title', __('task.web.edit'));
        $viewData->put('help', __('task.show', ['id' => $id]));
        $viewData->put('task', $this->serviceLayerData());

        return view('tasks.task_edit', compact('viewData'));
    }
}
