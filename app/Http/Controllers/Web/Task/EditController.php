<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\AbstractController;
use Illuminate\View\View;

class EditController extends AbstractController
{
    public function edit(int $id): View
    {
        $data = $this->answer->setAnswer(Show::show($id))->getData();

        $viewData = collect();
        $viewData->put('title', __('task.web.edit'));
        $viewData->put('help', __('task.show', ['id' => $id]));
        $viewData->put('task', $data);

        return view('tasks.task_edit', compact('viewData'));
    }
}
