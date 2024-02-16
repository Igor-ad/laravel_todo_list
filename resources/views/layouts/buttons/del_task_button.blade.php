<a type="button" class="btn btn-secondary @if($viewData['task']->status == 'done') disabled @endif"
    href="{{ route('web.delete', [$viewData['task']->id]) }}">{{ __('task.web.delete') }}</a>
