<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Update as Updater;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected AnswerService $answerService,
    )
    {
    }

    public function update(): JsonResponse
    {
        $this->answerService->setAnswer(Updater::update());

        return $this->answerService->getJsonResponse();
    }
}
