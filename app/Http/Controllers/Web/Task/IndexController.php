<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Index as Indexer;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IndexController extends AbstractController
{
    public function index(): View|RedirectResponse
    {
        $data = $this->answer->setAnswer(Indexer::index())->getData();

        $viewData = collect();
        $viewData->put('title', __('task.web.index'));
        $viewData->put('help', __('task.help.index'));
        $viewData->put('tasks', $data);

        return view('tasks.tasks', compact('viewData'));
    }
}
