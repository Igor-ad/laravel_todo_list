<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;
use App\Facades\Task\Index as Indexer;

class IndexController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected AnswerService $answerService,
    )
    {
    }

    public function index(): JsonResponse
    {
        $this->answerService->setAnswer(Indexer::index());

        return $this->answerService->getJsonResponse();
    }
}
