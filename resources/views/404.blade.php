@extends('layouts.master2')
@section('css')
    <!--- Internal Fontawesome css-->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!---Ionicons css-->
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <!---Internal Typicons css-->
    <link href="{{ URL::asset('assets/plugins/typicons.font/typicons.css') }}" rel="stylesheet">
    <!---Internal Feather css-->
    <link href="{{ URL::asset('assets/plugins/feather/feather.css') }}" rel="stylesheet">
    <!---Internal Falg-icons css-->
    <link href="{{ URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- Main-error-wrapper -->
    <div class="main-error-wrapper  page page-h ">
        <img src="{{ URL::asset('assets/img/media/404.png') }}" class="error-page" alt="error">
        <h2>{{ __('404.Oopps') }}</h2>
        <h6>{{ __('404.moved') }}</h6><a class="btn btn-outline-danger"
            href="{{ url('/' . ($page = 'home')) }}">{{ __('404.back') }}</a>
    </div>
    <!-- /Main-error-wrapper -->
@endsection
@section('js')
@endsection
