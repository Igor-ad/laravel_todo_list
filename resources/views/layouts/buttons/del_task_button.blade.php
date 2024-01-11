<a type="button" class="btn btn-secondary col-2 @if($task->status == 'done') disabled @endif"
    href="{{ route('web.delete', [$task->id]) }}">{{ __('task.web.delete') }}</a>
