<a type="button" class="btn btn-primary mb-1
@if($task->status == 'done') disabled @endif"
   href="{{ route('web.complete', [$task->id]) }}">{{ __('task.web.complete') }}</a>
