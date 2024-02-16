<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Controllers\ServiceMapper;
use Illuminate\Http\JsonResponse;
use App\Facades\Task\Index as Indexer;

class IndexController extends Controller
{
    use ServiceMapper, ResponseTrait;

    public function index(): JsonResponse
    {
        $this->answer()->setAnswer(Indexer::index());

        return $this->getJsonResponse();
    }
}
