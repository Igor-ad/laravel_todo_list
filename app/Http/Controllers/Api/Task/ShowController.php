<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected AnswerService $answerService,
    )
    {
    }

    public function show(int $id): JsonResponse
    {
        $this->answerService->setAnswer(Show::show($id));

        return $this->answerService->getJsonResponse();
    }
}
