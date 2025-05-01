<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Data\Request\Factories\Task\UpdateDataFactory;
use App\Facades\Task\Update as Updater;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    public function update(int $id, UpdateRequest $request): RedirectResponse
    {
        $data = UpdateDataFactory::make($request->validated())->getData();
        Updater::update($id, $data);

        return redirect(route('web.show', ['task' => $id]));
    }
}
