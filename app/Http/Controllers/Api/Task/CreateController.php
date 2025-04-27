<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Create as Creator;
use App\Http\Controllers\AbstractController;
use Illuminate\Http\JsonResponse;

class CreateController extends AbstractController
{
    public function create(): JsonResponse
    {
        $this->answer->setAnswer(Creator::create());

        return $this->getJsonResponse();
    }
}
