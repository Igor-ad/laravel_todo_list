<form method="POST" action="{{ route('web.logout') }}">
    @csrf
    <a class="nav-link active" href="{{ route('web.logout') }}"
       onclick="event.preventDefault();
       this.closest('form').submit();">{{ __('web.task.log_out') }}</a>
</form>
