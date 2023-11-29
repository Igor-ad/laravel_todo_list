<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\CreateService;
use Illuminate\Http\JsonResponse;

class CreateController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected CreateService $createService,
        protected AnswerService $answerService,
    )
    {
    }

    public function create(): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->createService, 'create');

        return $this->answerService->getJsonResponse();
    }
}
