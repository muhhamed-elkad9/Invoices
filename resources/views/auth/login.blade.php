@extends('layouts.master3')

@section('title')
    تسجيل الدخول - برنامج الفواتير
@stop


@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 style="margin-bottom: 1rem;">{{ __('login.Sign-In') }}</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>{{ __('login.or_use') }}</span>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="{{ __('login.Email') }}" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" placeholder="{{ __('login.Password') }}">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <a href="#">{{ __('login.Forget') }}</a>
                <button type="submit">{{ __('login.log-in') }}</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>{{ __('login.welcome') }}</h1>
                    <p>{{ __('login.Enter') }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ URL::asset('assets/js/login.js') }}"></script>
@endsection
