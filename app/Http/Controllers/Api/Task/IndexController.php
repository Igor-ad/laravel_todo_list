<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;
use App\Facades\Task\Index as Indexer;

class IndexController extends AbstractController
{
    public function index(): JsonResponse
    {
        $this->answer->setAnswer(Indexer::index());

        return $this->getJsonResponse();
    }
}
