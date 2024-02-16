<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Index as Indexer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\View\View;

class IndexController extends Controller
{
    use ServiceMapper;

    public function index(): View
    {
        $this->answer()->setAnswer(Indexer::index());

        $viewData = collect();
        $viewData->put('title', __('task.web.index'));
        $viewData->put('help', $this->serviceLayerMsg());
        $viewData->put('tasks', $this->serviceLayerData());

        return view('tasks.tasks', compact('viewData'));
    }
}
