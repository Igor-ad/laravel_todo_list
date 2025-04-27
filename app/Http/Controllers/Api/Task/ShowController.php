<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class ShowController extends AbstractController
{
    public function show(int $id): JsonResponse
    {
        $this->answer->setAnswer(Show::showWithBranches($id));

        return $this->getJsonResponse();
    }
}
