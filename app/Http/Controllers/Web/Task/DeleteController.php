<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Delete as Eraser;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    use ServiceMapper;

    public function delete(int $id): RedirectResponse
    {
        $this->answer()->setAnswer(Eraser::delete($id));

        return redirect(route('web.index'));
    }
}
