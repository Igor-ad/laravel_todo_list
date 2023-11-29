<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CreateService;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected CreateService $taskService,
        protected AnswerService $answerService,
    )
    {
    }

    public function create(): RedirectResponse
    {
        $this->answerService = $this->getAnswer($this->taskService, 'create');

        return redirect(route('web.index'));
    }
}
