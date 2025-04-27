<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Update as Updater;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\RedirectResponse;

class UpdateController extends AbstractController
{
    public function update(int $id): RedirectResponse
    {
        $this->answer->setAnswer(Updater::update($id));

        return redirect(route('web.show', ['task' => $id]));
    }
}
