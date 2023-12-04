<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Update as Updater;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    use ServiceMapper;

    public function update(int $id): RedirectResponse
    {
        $this->answerService->setAnswer(Updater::update($id));

        return redirect(route('web.show', ['task' => $id]));
    }
}
