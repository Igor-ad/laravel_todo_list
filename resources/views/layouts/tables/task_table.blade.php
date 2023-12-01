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
        <th>{{ __('task.web.edit') }}
            / {{ __('task.web.show') }}
            / {{ __('task.web.complete') }}
            / {{ __('task.web.delete') }}</th>
    </tr>
    </thead>
    <tbody>
@forelse($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->parent_id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->priority }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->created_at }}</td>
            <td>{{ $task->completed_at }}</td>
            <td>
                <a type="button" class="btn btn-primary"
                   href="{{ route('web.edit', [$task->id]) }}">&Delta;</a>
                <a type="button" class="btn btn-primary"
                   href="{{ route('web.show', [$task->id]) }}">&Theta;</a>
                <a type="button" class="btn btn-primary
@if($task->status == 'done') disabled @endif"
                   href="{{ route('web.complete', [$task->id]) }}">&oplus;</a>
                <a type="button" class="btn btn-secondary"
                   href="{{ route('web.delete', [$task->id]) }}">&otimes;</a>
            </td>
        </tr>
@empty
        <h5>{{ __('task.web.empty') }}</h5>
@endforelse
    </tbody>
</table>
