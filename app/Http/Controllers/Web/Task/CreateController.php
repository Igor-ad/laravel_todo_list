<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Create as Creator;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\RedirectResponse;

class CreateController extends AbstractController
{
    public function create(): RedirectResponse
    {
        $this->answer->setAnswer(Creator::create());

        return redirect(route('web.index'));
    }
}
