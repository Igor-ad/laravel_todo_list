<a type="button" class="btn btn-secondary mb-1
@if($task->status == 'done') disabled @endif"
   href="{{ route('web.delete', [$task->id]) }}">{{ __('task.web.delete') }}</a>
