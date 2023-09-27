<!-- start navigation -->
@section('navigation')
    @include('layouts.nav_bars.nav_bar')
@show
<!-- start header -->
@section('header')
    @include('layouts.header')
@show
<!-- start content -->
@section('content')
    {{ __('task.web.content') }}
@show
<!-- start footer -->
@section('footer')
    @include('layouts.footer')
@show
