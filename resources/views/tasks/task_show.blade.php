@extends('layouts.base')
@section('content')
    @include('layouts.breadcrumbs.task_parents')
    @include('layouts.breadcrumbs.task_children')
    <div class="card mb-3">
        <div class="card-body">
    @include('layouts.buttons.complete_task_button')
    @include('layouts.buttons.edit_task_button')
    @include('layouts.buttons.del_task_button')
        </div>
    </div>
    @include('layouts.forms.task_show')
@endsection
