<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CompleteService;
use Illuminate\Http\JsonResponse;

class CompleteController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected CompleteService $completeService,
        protected AnswerService   $answerService,
    )
    {
    }

    public function complete(int $id): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->completeService, 'complete', $id);

        return $this->answerService->getJsonResponse();
    }
}
