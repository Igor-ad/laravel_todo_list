<?php

namespace App\Http\Controllers\Web;

use App\Enums\TaskPathEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CompleteService;
use Illuminate\Http\RedirectResponse;

class TaskCompleteController extends Controller
{
    use ServiceMapper;

    /**
     * @param CompleteService $completeService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected CompleteService $completeService,
        protected AnswerService   $answerService,
    )
    {
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function complete(int $id): RedirectResponse
    {
        $this->answerService = $this->getAnswer($this->completeService, 'complete', $id);

        return redirect(TaskPathEnum::show->value . $id);
    }
}
