<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Complete;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\RedirectResponse;

class CompleteController extends AbstractController
{
    public function complete(int $id): RedirectResponse
    {
        $this->answer->setAnswer(Complete::complete($id));

        return redirect(route('web.show', ['task' => $id]));
    }
}
