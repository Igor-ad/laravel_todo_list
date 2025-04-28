<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Data\Request\Factories\Task\UpdateDataFactory;
use App\Facades\Task\Update as Updater;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;

class UpdateController extends BaseApiController
{
    public function update(int $id, UpdateRequest $request): JsonResponse
    {
        $data = (new UpdateDataFactory($request->validated()))->getData();
        $result = Updater::update($id, $data);

        return $this->jsonResponse(
            message: __('task.update'),
            data: TaskResource::make($result)
        );
    }
}
