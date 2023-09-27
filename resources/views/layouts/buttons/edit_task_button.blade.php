@php use App\Enums\TaskPathEnum; @endphp

<a type="button" class="btn btn-primary mb-1"
   href="{{ TaskPathEnum::edit->value . $task->id }}">{{ __('task.web.edit') }}</a>
