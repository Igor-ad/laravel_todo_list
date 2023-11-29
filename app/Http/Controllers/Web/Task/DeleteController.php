<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\DeleteService;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected DeleteService $deleteService,
        protected AnswerService $answerService,
    )
    {
    }

    public
    function delete(int $id): RedirectResponse
    {
        $this->answerService = $this->getAnswer($this->deleteService, 'delete', $id);

        return redirect(route('web.index'));
    }
}
