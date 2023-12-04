<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Complete;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\RedirectResponse;

class CompleteController extends Controller
{
    use ServiceMapper;

    public function complete(int $id): RedirectResponse
    {
        $this->answerService->setAnswer(Complete::complete($id));

        return redirect(route('web.show', ['task' => $id]));
    }
}
