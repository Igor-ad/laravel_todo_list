<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Complete;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CompleteController extends Controller
{
    public function complete(int $id): RedirectResponse
    {
        Complete::complete($id);

        return redirect(route('web.show', ['task' => $id]));
    }
}
