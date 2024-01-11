<div class="card mb-3">
    <div class="card-body">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-md-0">
                <li class="col-sm-1 fw-bold">{{__('task.breadcrumbs.children') }}</li>
                <li class="breadcrumb-item" aria-current="page">{{ $task->id }}</li>
                @foreach($childrenId as $id)
                    <li class="breadcrumb-item"><a href="{{ route('web.show', [$id]) }}">{{ $id }}</a></li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>

