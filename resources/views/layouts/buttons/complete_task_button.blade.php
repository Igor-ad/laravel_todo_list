@php use App\Enums\TaskPathEnum; @endphp

<a type="button" class="btn btn-primary mb-1
@if($task->status == 'done') disabled @endif"
   href="{{ TaskPathEnum::complete->value . $task->id }}">{{ __('task.web.complete') }}</a>
