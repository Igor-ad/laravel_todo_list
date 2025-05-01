<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Task;

use App\Facades\Task\Show;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskWithBranchesResource;
use App\Http\Resources\TaskWithChildrenResource;
use App\Http\Resources\TaskWithParentResource;
use \Illuminate\Http\JsonResponse;

class ShowController extends BaseApiController
{
    /**
     * Allowed service methods:
     * Show::showWithBranches($id) // data: TaskWithBranchesResource::make(Show::showWithBranches($id))
     * Show::showWithParent($id) // data: TaskWithParentResource::make(Show::showWithParent($id))
     * Show::show($id) // data: TaskResource::make(Show::show($id))
     * Show::showWithChildren($id) // data: TaskWithChildrenResource::make(Show::showWithChildren($id))
     */
    public function show(int $id): JsonResponse
    {
        return $this->jsonResponse(
            message:  __('task.show', ['id' => $id]),
            data: TaskWithBranchesResource::make(Show::showWithBranches($id))
        );
    }
}
