<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Data\Request\Factories\Task\IndexDataFactory;
use App\Facades\Task\Index as Indexer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\IndexRequest;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(IndexRequest $request): View
    {
        $data = (new IndexDataFactory($request->validated()))->getData();

        $viewData = collect()
            ->put('tasks', Indexer::index($data))
            ->put('title', __('task.web.index'))
            ->put('help', __('task.help.index'));

        return view('tasks.tasks', compact('viewData'));
    }
}
