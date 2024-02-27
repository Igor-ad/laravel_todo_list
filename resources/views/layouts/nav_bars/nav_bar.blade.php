<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('web.index') }}">{{ config('app.alias') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                       href="{{ route('web.index') }}">{{ __('task.web.index') }}</a>
                </li>
@if (Route::has('login'))
@auth
               <li class="nav-item">
                        <a class="nav-link active"
                        href="{{ route('web.add') }}">{{ __('task.web.add') }}</a>
               </li>
               <li class="nav-item">
@include('layouts.forms.logout')
               </li>
@else
                <li class="nav-item">
                    <a class="nav-link active"
                       href="#">{{ __('task.web.login') }}</a>
                </li>
@if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link active"
                       href="#">{{ __('task.web.register') }}</a>
                </li>
@endif
@endauth
@endif
            </ul>
        </div>
    </div>
</nav>
