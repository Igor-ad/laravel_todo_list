@php use App\Enums\TaskPathEnum; @endphp

<a type="button" class="btn btn-primary mb-1"
   href="{{ TaskPathEnum::add->value }}">{{ __('task.web.add') }}</a>
