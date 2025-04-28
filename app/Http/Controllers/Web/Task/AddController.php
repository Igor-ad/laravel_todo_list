<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AddController extends Controller
{
    public function add(): View
    {
        $viewData = collect();
        $viewData->put('title', __('task.web.create'));
        $viewData->put('help', __('task.help.create'));

        return view('tasks.task_add', compact('viewData'));
    }
}
