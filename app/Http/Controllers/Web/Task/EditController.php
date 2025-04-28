<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class EditController extends Controller
{
    public function edit(int $id): View
    {
        $viewData = collect()
            ->put('task', Show::show($id))
            ->put('title', __('task.web.edit'))
            ->put('help', __('task.show', ['id' => $id]));

        return view('tasks.task_edit', compact('viewData'));
    }
}
