<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\JsonResponse;

class ShowController extends Controller
{
    use ServiceMapper, ResponseTrait;

    public function show(int $id): JsonResponse
    {
        $this->answer()->setAnswer(Show::showWithBranches($id));

        return $this->getJsonResponse();
    }
}
