<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;
use App\Facades\Task\Complete as Completer;

class CompleteController extends AbstractController
{
    public function complete(int $id): JsonResponse
    {
        $this->answer->setAnswer(Completer::complete($id));

        return $this->getJsonResponse();
    }
}
