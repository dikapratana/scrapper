@extends('layouts.base_template')

@section('class-body', 'hold-transition skin-blue sidebar-mini')

@section('layout')
<div class="wrapper">
    @include('layouts.partials.nav')

    @include('layouts.partials.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            @yield('content-header')
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>

    @include('layouts.partials.footer')
</div>
@endsection
