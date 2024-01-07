@extends('layouts.base')
@section('content')
    <div class="card mb-3">
        <div class="card-body">
            @include('layouts.buttons.new_task_button')
        </div>
    </div>
    @include('layouts.messages.error_show')
    @include('layouts.tables.task_table')
@endsection
