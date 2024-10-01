@php
    $currentUrl = url()->full();
@endphp

@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<div class="header">
    <div class="first-container d-md-block d-none">
        <div class="container">
            {{ setting('bh_telephone', '') }}
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container navbar-container">
            {{-- <a class="navbar-brand" href="#"> --}}
            <div class="logo">
                <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ themes('images/bH-current-logo.png') }}"
                        alt="48pay-logo" style="width: 120px;" /></a>
            </div>
            {{-- </a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown {{ in_array($currentUrl, [route('greeting'), route('business-model'), route('competitiveness'), route('branch-representative'), route('representative-registration'), route('compensation'), route('install-app')]) ? 'activeclass' : '' }}">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            My HUB&nbsp;<i style="font-size: 12px;position: relative;top:-3px;" class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('greeting') ? 'activeclass' : '' }}" href="{{ route('greeting') }}">인사말</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('business-model') ? 'activeclass' : '' }}" href="{{ route('business-model') }}">비즈니스 모델</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('competitiveness') ? 'activeclass' : '' }}" href="{{ route('competitiveness') }}">“My HUB” 경쟁력</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('branch-representative') ? 'activeclass' : '' }}" href="{{ route('branch-representative') }}">지사대표(BP)란?</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('representative-registration') ? 'activeclass' : '' }}" href="{{ route('representative-registration') }}">지사대표 등록과정</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('compensation') ? 'activeclass' : '' }}" href="{{ route('compensation') }}">구조 및 보상</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('install-app') ? 'activeclass' : '' }}" href="{{ route('install-app') }}">“My HUB” 앱 설치</a>
                            </li>
                        </ul>
                    </li>

                    <div class="col-b" id="tab-2">
                        <a class="nav-link {{ Request::routeIs('sales.item-listing') ? 'activeclass' : '' }}" href="{{ route('sales.item-listing') }}">
                            세일즈 아이템
                        </a>
                    </div>
                    <div class="col-c" id="tab-3">
                        <a class="nav-link {{ Request::routeIs('academy.view') ? 'activeclass' : '' }}" href="{{ route('academy.view') }}">
                            My 아카데미
                        </a>
                    </div>
                    <li class="nav-item dropdown {{ in_array($currentUrl, [route('monthly-news.view'), route('faq'), route('instructions'), route('way-to-come')]) ? 'activeclass' : '' }}">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        고객센터 <i style="font-size: 12px;position: relative;top:-3px;" class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('monthly-news.view') ? 'activeclass' : '' }}" href="{{ route('monthly-news.view') }}">월간뉴스</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('faq') ? 'activeclass' : '' }}" href="{{ route('faq') }}">자주하는 질문 (FAQ)</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('instructions') ? 'activeclass' : '' }}" href="{{ route('instructions') }}">이용 안내 및 문의</a>
                            </li>
                            <li style="padding: 5px 10px;">
                                <a class="dropdown-item {{ Request::routeIs('way-to-come') ? 'activeclass' : '' }}" href="{{ route('way-to-come') }}">오시는 길</a>
                            </li>
                        </ul>
                    </li>
                    <div class="col-e" id="tab-5">
                        <a class="nav-link {{ Request::routeIs('recruitment-representatives.view') ? 'activeclass' : '' }}" href="{{route('recruitment-representatives.view')}}">
                            지사대표 모집
                        </a>
                    </div>
                    <div class="col-f d-none" id="tab-6">
                        @if(Auth::check())
                            @if (auth()->user())
                                <a class="nav-link {{ Request::routeIs('recruitment-representatives.view') ? 'activeclass' : '' }}" href="{{ 'sales/my-page/'.auth()->user()->code }}" class="btn btn-secondary">@lang('user::sale.my-page')</a>
                            @endif
                        @endif
                    </div>
                </ul>
                 @if(Auth::check())
                    <div class="button">
                        @if (auth()->user())
                            <a href="{{ url('sales/my-page/'.auth()->user()->code) }}" style="    color: #fd6f22 !important; border: 1px solid #fd6f22; background: #fff;" class="btn btn-primary">@lang('user::sale.my-page')</a>
                        @endif
                    </div>
                    &nbsp;
                    <div class="button">
                        <form id="logout-form" action="{{ $logout_url }}" method="POST">
                            @if(config('adminlte.logout_method'))
                                {{ method_field(config('adminlte.logout_method')) }}
                            @endif
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary"><i class="ti ti-logout me-2 ti-sm  d-none"></i>
                                <span class="align-middle">{{ __('user::top.logout') }}</span></button>
                        </form>
                    </div>
                @else
                    <div class="button">
                        <button type="button" class="btn btn-primary" id="button-1" onclick="location.href='{{ route('login') }}'">
                            {{ __('user::top.login') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>
<style>
    .navbar .dropdown a,
    .dropdown-tabs-customer a {
        color: #000000;
        text-decoration: none;
    }

    .dropdown-content a:hover,
    .dropdown-content-2 a:hover {
        color: #EC661A;
    }

    .activeclass {
        color: var(--main2, #EC661A) !important;
        font-weight: 600 !important;
    }

    .btn-primary:hover{
        color: #fff;
        background-color: #e15a11 !important;
        border-color: #e15a11 !important;
    }

    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
        color: #fff;
        background-color: #e15a11 !important;
        border-color: #e15a11 !important;
    }

    .btn-primary:focus {
        color: #fff;
        background-color: #e15a11 !important;
        border-color: #e15a11 !important;
    }
    
</style>
