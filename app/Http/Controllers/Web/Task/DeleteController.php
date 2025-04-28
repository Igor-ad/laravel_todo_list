<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Facades\Task\Delete as Eraser;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DeleteController extends Controller
{
    public function delete(int $id): RedirectResponse
    {
        Eraser::delete($id);

        return redirect(route('web.index'));
    }
}
