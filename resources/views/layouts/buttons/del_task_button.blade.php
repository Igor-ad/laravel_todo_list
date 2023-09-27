@php use App\Enums\TaskPathEnum; @endphp

<a type="button" class="btn btn-secondary mb-1
@if($task->status == 'done') disabled @endif"
   href="{{ TaskPathEnum::delete->value . $task->id }}">{{ __('task.web.delete') }}</a>
