<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Delete as Eraser;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceMapper;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;

class DeleteController extends Controller
{
    use ServiceMapper;

    public function __construct(
        protected AnswerService $answerService,
    )
    {
    }

    public
    function delete(int $id): JsonResponse
    {
        $this->answerService->setAnswer(Eraser::delete($id));

        return $this->answerService->getJsonResponse();
    }
}
