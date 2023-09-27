<?php

namespace App\Http\Controllers\Web;

use Illuminate\View\View;

class TaskAddController
{
    /**
     * @return View
     */
    public function add(): View
    {
        $title = __('task.web.create');
        $help = __('task.help.create');

        return view('tasks.task_add', compact('title', 'help'));
    }
}
