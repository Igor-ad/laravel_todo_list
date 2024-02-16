<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Update as Updater;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    use ServiceMapper, ResponseTrait;

    public function update(): JsonResponse
    {
        $this->answer()->setAnswer(Updater::update());

        return $this->getJsonResponse();
    }
}
