<table id="t1" class="table table-condensed table-striped">
    <thead>
    <tr>
        <th>{{ __('task.prop.id') }}</th>
        <th>{{ __('task.prop.parent_id') }}</th>
        <th>{{ __('task.prop.title') }}</th>
        <th>{{ __('task.prop.description') }}</th>
        <th>{{ __('task.prop.priority') }}</th>
        <th>{{ __('task.prop.status') }}</th>
        <th>{{ __('task.prop.created_at') }}</th>
        <th>{{ __('task.prop.completed_at') }}</th>
        <th>{{ __('task.web.edit') }}</th>
        <th>{{ __('task.web.delete') }}</th>
    </tr>
    </thead>
    <tbody>
@forelse($viewData['tasks'] as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->parent_id }}</td>
            <td><a href="{{ route('web.show', [$task->id]) }}"
                   data-bs-toggle="tooltip"
                   data-bs-title="{{ __('task.web.show') }}">{{ $task->title }}</a></td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->priority }}</td>
@if($task->status === 'todo')
            <td><a href="{{ route('web.complete', [$task->id]) }}"
                   data-bs-toggle="tooltip"
                   data-bs-title="{{ __('task.web.complete') }}">{{ $task->status }}</a></td>
@else
            <td>{{ $task->status }}</td>
@endif
            <td>{{ $task->created_at }}</td>
            <td>{{ $task->completed_at }}</td>
            <td><a type="button" class="btn btn-primary"
                   href="{{ route('web.edit', [$task->id]) }}">{{ __('task.web.edit') }}</a></td>
            <td><a type="button" class="btn btn-secondary"
                   href="{{ route('web.delete', [$task->id]) }}">{{ __('task.web.delete') }}</a></td>
        </tr>
@empty
        <h5>{{ __('task.web.empty') }}</h5>
@endforelse
    </tbody>
</table>
