@extends('layouts.master')
@section('title')
    {{ __('profile.Edit_Profile') }}
@stop
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('profile.Edit_Profile') }}</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: '{{ __('profile.edit_pro') }}',
                    type: "success"
                })
            }
        </script>
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-4">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="pl-0">
                        <div class="main-profile-overview">
                            <div class="main-img-user profile-user">
                                @if (Auth::user()->avatar == null)
                                    <img src="{{ URL::asset('avatars/user.jpg') }}">
                                @else
                                    <img src="{{ URL::asset('avatars/' . Auth::user()->id . '/' . Auth::user()->avatar) }}">
                                @endif
                                <a class="fas fa-camera profile-edit" data-toggle="modal" data-target="#photo_user"
                                    href="JavaScript:void(0);"></a>
                            </div>
                            <div class="d-flex justify-content-between mg-b-20">
                                <div>
                                    <h5 class="main-profile-name">{{ Auth::user()->name }}</h5>
                                    <p class="main-profile-name-text">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <h6>{{ __('profile.Bio') }}:</h6>
                            <div class="main-profile-bio">
                                @php
                                    echo implode(' | ', Auth::user()->roles_name);
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="active">
                                <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i
                                            class="las la-cog tx-16 mr-1"></i></span> <span
                                        class="hidden-xs">{{ __('profile.Settings') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                        <div class="tab-pane active" id="settings">
                            <form action="{{ route('profile.update', $user->id) }}" method="POST">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name">{{ __('profile.Name_User') }}:</label>
                                    <input type="text" value="{{ $user->name }}" name="name" id="name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('profile.Email') }}:</label>
                                    <input type="email" value="{{ $user->email }}" name="email" id="email"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Password">{{ __('profile.Password') }}:</label>
                                    <input type="password" placeholder="6 - 15 Characters" name="password" id="password"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password">{{ __('profile.Confirm-Password') }}</label>
                                    <input type="password" placeholder="6 - 15 Characters" name="confirm-password"
                                        id="confirm-password" class="form-control">
                                </div>
                                <button class="btn btn-primary waves-effect waves-light w-md"
                                    type="submit">{{ __('profile.Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
