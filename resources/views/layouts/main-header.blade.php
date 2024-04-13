<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/logo.png') }}"
                        class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="dark-logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                        class="logo-2" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('assets/img/brand/favicon.png') }}"
                        class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
            <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
                <input class="form-control" placeholder="Search for anything..." type="search"> <button
                    class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
            </div>
        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">
                    <div class="dropdown  nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                    src="{{ URL::asset('assets/img/flags/English.jpg') }}" alt="img"></span>
                            <div class="my-auto">
                                <strong class="mr-2 ml-2 my-auto">English</strong>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                    class="dropdown-item d-flex ">
                                    <span class="avatar ml-3 align-self-center bg-transparent"><img
                                            src="{{ URL::asset('assets/img/flags') . '/' . $properties['native'] . '.' . 'jpg' }}"
                                            alt="img"></span>
                                    <div class="d-flex">
                                        <span class="mt-2">{{ $properties['native'] }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
            <div class="nav nav-item  navbar-nav-right ml-auto">

                @can('الاشعارات')
                    <div class="dropdown nav-item main-header-notification">
                        <a class="new nav-link" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-bell">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                            </svg><span class="pulse"></span></a>
                        <div class="dropdown-menu">
                            <div class="menu-header-content bg-primary text-right">
                                <div class="d-flex">
                                    <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">
                                        {{ __('layouts/main-header.Notification') }}
                                    </h6>
                                    <a href="{{ route('invoices.MarkAsRead_all') }}"
                                        class="badge badge-pill badge-warning mr-auto my-auto float-left">{{ __('layouts/main-header.Mark_All_Read') }}</a>
                                </div>
                                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
                                    {{ __('layouts/main-header.Unread_Notification') }}:
                                <h6 style="color: yellow;" id="notifications_count">
                                    ({{ auth()->user()->unreadNotifications->count() }})</h6>
                                </p>
                            </div>
                            <div id="unreadNotifications">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <div class="main-notification-list Notification-scroll">
                                        <a class="d-flex p-3 border-bottom"
                                            href="{{ route('InvoicesDetails', $notification->data['id']) }}">
                                            <div class="mr-3">
                                                <h5 class="notification-label mb-1">{{ $notification->data['title'] }}
                                                    {{ $notification->data['user'] }}</h5>
                                                <div class="notification-subtext">{{ $notification->created_at }}</div>
                                            </div>
                                            <div class="mr-auto">
                                                <i class="las la-angle-left text-left text-muted"></i>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endcan
                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg"
                            class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-maximize">
                            <path
                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                            </path>
                        </svg></a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href="">

                        <div class="main-img-user">

                            @if (Auth::user()->avatar == null)
                                <img src="{{ URL::asset('avatars/user.jpg') }}">
                            @else
                                <img
                                    src="{{ URL::asset('avatars/' . Auth::user()->id . '/' . Auth::user()->avatar) }}">
                            @endif

                        </div>

                    </a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user">

                                    @if (Auth::user()->avatar == null)
                                        <img src="{{ URL::asset('avatars/user.jpg') }}">
                                    @else
                                        <img
                                            src="{{ URL::asset('avatars/' . Auth::user()->id . '/' . Auth::user()->avatar) }}">
                                    @endif

                                </div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ Auth::user()->name }}</h6><span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile.edit', Auth::user()->id) }}"><i
                                class="bx bx-cog"></i>{{ __('layouts/main-header.Edit_Profile') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="bx bx-log-out"></i>{{ __('layouts/main-header.sign_out') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /main-header -->
