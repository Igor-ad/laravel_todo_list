@php use App\Enums\TaskPathEnum; @endphp

<form class="d-flex" role="search" method="post" action="{{ route(TaskPathEnum::index->name) }}">
    @csrf
    <input name="card" id="input-card"
           class="form-control me-2"
           type="search"
           placeholder="Search"
           aria-label="Search">
    <input name="card" id="input-card"
           class="form-control me-2"
           type="search"
           placeholder="Search"
           aria-label="Search">
    <input name="card" id="input-card"
           class="form-control me-2"
           type="search"
           placeholder="Search"
           aria-label="Search">
    <input name="card" id="input-card"
           class="form-control me-2"
           type="search"
           placeholder="Search"
           aria-label="Search">
    <button class="btn btn-primary" type="submit">{{ __('web.task.search') }}</button>
</form>
<br>
@include('layouts.messages.error_show')
