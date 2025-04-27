<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Update as Updater;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class UpdateController extends AbstractController
{
    public function update(): JsonResponse
    {
        $this->answer->setAnswer(Updater::update());

        return $this->getJsonResponse();
    }
}
