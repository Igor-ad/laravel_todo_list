<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Task;

use App\Data\Request\Factories\Task\CreateDataFactory;
use App\Facades\Task\Create as Creator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use Illuminate\Http\RedirectResponse;

class CreateController extends Controller
{
    public function create(CreateRequest $request): RedirectResponse
    {
        $data = CreateDataFactory::make($request->validated())->getData();
        Creator::create($data);

        return redirect(route('web.index'));
    }
}
