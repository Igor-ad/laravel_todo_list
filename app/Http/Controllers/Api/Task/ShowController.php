<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\ShowService;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected ShowService   $showService,
        protected AnswerService $answerService,
    )
    {
    }

    public function show(int $id): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->showService, 'show', $id);

        return $this->answerService->getJsonResponse();
    }
}
