<div class="card mb-3">
    <div class="card-body">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-md-0">
                <li class="col-sm-1 fw-bold">{{__('task.breadcrumbs.children') }}</li>
                <li class="breadcrumb-item" aria-current="page">{{ $viewData['task']->id }}</li>
@foreach($viewData['childrenId'] as $id => $status)
@if($status === 'done')
                <li class="breadcrumb-item"><a href="{{ route('web.show', [$id]) }}" class="text-success">{{ "$id" }}</a></li>
@else
                <li class="breadcrumb-item"><a href="{{ route('web.show', [$id]) }}" class="text-warning">{{ "$id" }}</a></li>
@endif
@endforeach
            </ol>
        </nav>
    </div>
</div>

