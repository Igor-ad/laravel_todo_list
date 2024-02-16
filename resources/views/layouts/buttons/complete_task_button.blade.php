<a type="button" class="btn btn-primary @if($viewData['task']->status == 'done') disabled @endif"
    href="{{ route('web.complete', [$viewData['task']->id]) }}">{{ __('task.web.complete') }}</a>
