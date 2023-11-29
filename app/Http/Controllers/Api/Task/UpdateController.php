<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use App\Services\Task\UpdateService;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected UpdateService $updateService,
        protected AnswerService $answerService,
    )
    {
    }

    public function update(): JsonResponse
    {
        $this->answerService = $this->getAnswer($this->updateService, 'update');

        return $this->answerService->getJsonResponse();
    }
}
