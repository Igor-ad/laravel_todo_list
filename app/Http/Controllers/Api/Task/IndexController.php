<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Data\Request\Factories\Task\IndexDataFactory;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Task\IndexRequest;
use App\Http\Resources\TaskCollection;
use App\Facades\Task\Index as Indexer;
use Illuminate\Http\JsonResponse;

class IndexController extends BaseApiController
{
    public function index(IndexRequest $request): JsonResponse
    {
        $data = (new IndexDataFactory($request->validated()))->getData();

        return $this->jsonResponse(
            message:  __('task.index'),
            data: TaskCollection::make(Indexer::index($data)),
        );
    }
}
