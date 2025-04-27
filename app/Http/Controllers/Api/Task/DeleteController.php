<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Delete as Eraser;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class DeleteController extends AbstractController
{
    public function delete(int $id): JsonResponse
    {
        $this->answer->setAnswer(Eraser::delete($id));

        return $this->getJsonResponse();
    }
}
