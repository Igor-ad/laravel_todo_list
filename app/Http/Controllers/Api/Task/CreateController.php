<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Create as Creator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    use ServiceMapper;

    public function create(): JsonResponse
    {
        $this->answerService->setAnswer(Creator::create());

        return $this->answerService->getJsonResponse();
    }
}
