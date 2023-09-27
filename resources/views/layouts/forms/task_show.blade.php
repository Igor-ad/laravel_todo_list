<div class="card mb-3">
    <div class="card-body">
        <div class="container align-content-lg-end">
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.id') }}</div>
                <div class="col-sm-10">{{ $task->id }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.parent_id') }}</div>
                <div class="col-sm-10">{{ $task->parent_id }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.title') }}</div>
                <div class="col-sm-10">{{ $task->title }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.description') }}</div>
                <div class="col-sm-10">{{ $task->description }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.status') }}</div>
                <div class="col-sm-10">{{ $task->status }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.priority') }}</div>
                <div class="col-sm-10">{{ $task->priority }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.created_at') }}</div>
                <div class="col-sm-10">{{ $task->created_at }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.updated_at') }}</div>
                <div class="col-sm-10">{{ $task->updated_at }}</div>
            </div>
            <div class="row mb-1">
                <div class="col-sm-2 fw-bold">{{ __('task.prop.completed_at') }}</div>
                <div class="col-sm-10">{{ $task->completed_at }}</div>
            </div>
        </div>
    </div>
</div>
