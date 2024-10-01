@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('title') Login @stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_header', trans('core::login.sign-in-to-start-your-session'))

@section('auth_body')
    <form action="{{ $login_url }}" method="post">

        @csrf

        {{-- Email field --}}
        <div class="mb-3">
            <label class="from-label">{{ trans('core::login.email') }}</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ trans('core::login.email') }}" autofocus>


            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="mb-3">
            <label class="from-label">{{ trans('core::login.password') }}</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ trans('core::login.password') }}">

            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-12">
                <div class="icheck-primary" title="{{ trans('core::login.remember-me') }}" style="width: 100%;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember" style="min-width: 220px;">
                        {{ trans('core::login.remember-me') }}
                    </label>
                </div>
            </div>

            <div class="col-12">
                <button type=submit class="mt-3 w-100 btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    {{ trans('core::login.sign-in') }}
                </button>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-12">
                @error('inactive')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>

    </form>
    <hr>
    <div class="row">

        <div class="col-12">
            <a href="{{route('registration')}}" class="mt-3 w-100 btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                {{-- TODO: it is hard-coded because of now on database migration - HWAN OH --}}
                지사대표(BP) 신규 등록
            </a>
        </div>
    </div>
@stop

@section('auth_footer')

<div class="text-center">
    <a class="login-link" href="{{route('find-password')}}">{{ trans('core::login.find-password') }}</a>
    <div class="vertical-divider"></div>
    <a class="login-link" href="{{route('find-id')}}">{{ trans('core::login.find-id') }}</a>
    <!--
    <div class="vertical-divider"></div>
    <a class="login-link" href="{{route('registration')}}">{{ trans('core::login.create-account') }}</a>
    -->
</div>
<!-- <div class="d-flex align-items-center p-2">
    <hr class="w-100"/>
    <span class="px-2">or</span>
    <hr class="w-100"/>
</div> -->

<!-- <div class="d-flex justify-content-center flex-wrap gap-3">
    <button class="btn" style="color: rgb(66, 103, 178);caret-color: rgb(66, 103, 178);height: 38px;width: 38px; background: #e0e6f3;padding:0;">
    <svg style="width:25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47062 14 5.5 16 5.5H17.5V2.1401C17.1743 2.09685 15.943 2 14.6429 2C11.9284 2 10 3.65686 10 6.69971V9.5H7V13.5H10V22H14V13.5Z" fill="currentColor"></path></svg>
    </button>
    <button class="btn" style="color: rgb(221, 75, 57);caret-color: rgb(221, 75, 57);height: 38px;width: 38px; background: #fae2df;padding:0;">
    <svg style="width:25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3.06364 7.50914C4.70909 4.24092 8.09084 2 12 2C14.6954 2 16.959 2.99095 18.6909 4.60455L15.8227 7.47274C14.7864 6.48185 13.4681 5.97727 12 5.97727C9.39542 5.97727 7.19084 7.73637 6.40455 10.1C6.2045 10.7 6.09086 11.3409 6.09086 12C6.09086 12.6591 6.2045 13.3 6.40455 13.9C7.19084 16.2636 9.39542 18.0227 12 18.0227C13.3454 18.0227 14.4909 17.6682 15.3864 17.0682C16.4454 16.3591 17.15 15.3 17.3818 14.05H12V10.1818H21.4181C21.5364 10.8363 21.6 11.5182 21.6 12.2273C21.6 15.2727 20.5091 17.8363 18.6181 19.5773C16.9636 21.1046 14.7 22 12 22C8.09084 22 4.70909 19.7591 3.06364 16.4909C2.38638 15.1409 2 13.6136 2 12C2 10.3864 2.38638 8.85911 3.06364 7.50914Z" fill="currentColor"></path></svg>
    </button>
    <button class="btn" style="color: rgb(29, 161, 242);caret-color: rgb(29, 161, 242);height: 38px;width: 38px; background: #daf0fd;padding:0;">
    <svg style="width:25px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22.2125 5.65605C21.4491 5.99375 20.6395 6.21555 19.8106 6.31411C20.6839 5.79132 21.3374 4.9689 21.6493 4.00005C20.8287 4.48761 19.9305 4.83077 18.9938 5.01461C18.2031 4.17106 17.098 3.69303 15.9418 3.69434C13.6326 3.69434 11.7597 5.56661 11.7597 7.87683C11.7597 8.20458 11.7973 8.52242 11.8676 8.82909C8.39047 8.65404 5.31007 6.99005 3.24678 4.45941C2.87529 5.09767 2.68005 5.82318 2.68104 6.56167C2.68104 8.01259 3.4196 9.29324 4.54149 10.043C3.87737 10.022 3.22788 9.84264 2.64718 9.51973C2.64654 9.5373 2.64654 9.55487 2.64654 9.57148C2.64654 11.5984 4.08819 13.2892 6.00199 13.6731C5.6428 13.7703 5.27232 13.8194 4.90022 13.8191C4.62997 13.8191 4.36771 13.7942 4.11279 13.7453C4.64531 15.4065 6.18886 16.6159 8.0196 16.6491C6.53813 17.8118 4.70869 18.4426 2.82543 18.4399C2.49212 18.4402 2.15909 18.4205 1.82812 18.3811C3.74004 19.6102 5.96552 20.2625 8.23842 20.2601C15.9316 20.2601 20.138 13.8875 20.138 8.36111C20.138 8.1803 20.1336 7.99886 20.1256 7.81997C20.9443 7.22845 21.651 6.49567 22.2125 5.65605Z" fill="currentColor"></path></svg>
    </button>
</div> -->
@stop
