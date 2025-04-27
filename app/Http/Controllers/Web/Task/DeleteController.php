<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Delete as Eraser;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\RedirectResponse;

class DeleteController extends AbstractController
{
    public function delete(int $id): RedirectResponse
    {
        $this->answer->setAnswer(Eraser::delete($id));

        return redirect(route('web.index'));
    }
}
