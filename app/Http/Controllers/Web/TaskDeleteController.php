<?php

namespace App\Http\Controllers\Web;

use App\Enums\TaskPathEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\DeleteService;
use Illuminate\Http\RedirectResponse;

class TaskDeleteController extends Controller
{
    use ServiceMapper;

    /**
     * @param DeleteService $deleteService
     * @param AnswerService $answerService
     */
    public function __construct(
        protected DeleteService $deleteService,
        protected AnswerService $answerService,
    )
    {
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public
    function delete(int $id): RedirectResponse
    {
        $this->answerService = $this->getAnswer($this->deleteService, 'delete', $id);

        return redirect(TaskPathEnum::index->value);
    }
}
