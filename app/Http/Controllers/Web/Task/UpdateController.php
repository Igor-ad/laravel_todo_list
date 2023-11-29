<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\UpdateService;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected UpdateService $taskService,
        protected AnswerService $answerService,
    )
    {
    }

    public function update(int $id): RedirectResponse
    {
        $this->answerService = $this->getAnswer($this->taskService, 'update');

        return redirect(route('web.show', ['task' => $id]));
    }
}
