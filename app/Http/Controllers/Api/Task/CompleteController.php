<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;
use App\Facades\Task\Complete as Completer;

class CompleteController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected AnswerService $answerService,
    )
    {
    }

    public function complete(int $id): JsonResponse
    {
        $this->answerService->setAnswer(Completer::complete($id));

        return $this->answerService->getJsonResponse();
    }
}
