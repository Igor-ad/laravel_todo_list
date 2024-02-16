<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Create as Creator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    use ServiceMapper;

    public function create(): RedirectResponse
    {
        $this->answer()->setAnswer(Creator::create());

        return redirect(route('web.index'));
    }
}
