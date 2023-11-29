<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\IndexService;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected IndexService  $indexService,
        protected AnswerService $answerService,
    )
    {
    }

    public function index(): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->indexService, 'index');

        return $this->answerService->getJsonResponse();
    }
}
