<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Data\Request\Factories\Task\CreateDataFactory;
use App\Facades\Task\Create as Creator;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends BaseApiController
{
    public function create(CreateRequest $request): JsonResponse
    {
        $data = (new CreateDataFactory($request->validated()))->getData();
        $result = Creator::create($data);

        return $this->jsonResponse(
            message: __('task.create'),
            data: TaskResource::make($result),
            status: Response::HTTP_CREATED,
        );
    }
}
