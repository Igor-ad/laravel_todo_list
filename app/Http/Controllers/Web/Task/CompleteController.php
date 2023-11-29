<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CompleteService;
use Illuminate\Http\RedirectResponse;

class CompleteController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected CompleteService $completeService,
        protected AnswerService   $answerService,
    )
    {
    }

    public function complete(int $id): RedirectResponse
    {
        $this->answerService = $this->getAnswer($this->completeService, 'complete', $id);

        return redirect(route('web.show', ['task' => $id]));
    }
}
