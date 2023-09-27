@php use App\Enums\PathEnum; @endphp
<form method="POST" action="{{ PathEnum::logout->value }}">
    @csrf
    <a class="nav-link active" href="{{ PathEnum::logout->value }}"
       onclick="event.preventDefault();
       this.closest('form').submit();">{{ __('web.task.log_out') }}</a>
</form>
