<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use Illuminate\View\View;

class AddController
{
    public function add(): View
    {
        $title = __('task.web.create');
        $help = __('task.help.create');

        return view('tasks.task_add', compact('title', 'help'));
    }
}
