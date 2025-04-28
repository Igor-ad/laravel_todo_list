<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\TaskWithBranchesResource;
use \Illuminate\Http\JsonResponse;

class ShowController extends BaseApiController
{
    /**
     * Allowed service methods:
     * Show::showWithParent($id)
     * Show::show($id)
     * Show::showWithChildren($id
     */
    public function show(int $id): JsonResponse
    {
        return $this->jsonResponse(
            message:  __('task.show', ['id' => $id]),
            data: TaskWithBranchesResource::make(Show::showWithBranches($id))
        );
    }
}
