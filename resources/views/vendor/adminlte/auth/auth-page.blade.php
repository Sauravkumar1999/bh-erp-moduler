@extends('adminlte::master')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page' }}@stop

<style>
  .login-wrapper{
    background: #f8f7fa;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .login-logo {
    margin: 0 auto;
  }
  .login-wrapper .login-box {
    height: auto;
    display: flex;
    align-items: center;
    padding: 20px;
    width: fit-content;
    margin: auto;
    position: relative;
  }

  .login-wrapper .login-box:before {
    content: " ";
    position: absolute;
    top:-60px;
    left: -30px;
    width: 230px;
    height: 230px;
    background-image: url(/images/login-bg-top.svg);
    background-repeat: no-repeat;
    background-size: contain;
}

.login-wrapper .login-box:after {
    content: " ";
    position: absolute;
    bottom:-35px;
    right: -30px;
    width: 180px;
    height: 180px;
    background-image: url(/images/login-bg-bottom.svg);
    background-repeat: no-repeat;
    background-size: contain;
}

  .login-wrapper .login-box .card{
    width: 100%;
    max-width: 400px;
    margin: auto;
    height: auto;
    justify-content: center;
    padding: 2rem;
    box-shadow: 0 0.25rem 1.125rem rgba(75,70,92,.1) !important;
    border-radius: 10px;
    z-index: 100;
  }

  .login-wrapper .login-box .card .card-header,
  .login-wrapper .login-box .card .card-body{
    padding: 20px 0;
    flex:0 !important;
  }

  .login-wrapper .login-box .card .card-footer{
    padding: 0 !important;
  }

  .login-wrapper .login-box .card .card-footer p{
    margin: 0;
  }

  .login-wrapper .login-img-box{
    padding: 2rem 0 2rem 2rem;
    height: calc(100vh - 0px);
  }

  .login-wrapper .login-img-box img{
    width: 100%;
    max-height:65%;
    object-fit:contain;
  }

  .login-img-box-wrapper{
    background-color: #f8f7fa;
    border-radius: 20px;
  }

  #template-customizer {
    display: none !important;
  }

  @media(max-width:576px){
    .login-wrapper .login-box:before,   .login-wrapper .login-box:after{
      display: none;
    }
  }

  .vertical-divider {
    border-right: 2px solid #525252;
    height: 12px;
    margin-right: 8px;
    margin-left: 8px;
    box-sizing: border-box;
    display: inline-block;
}

.login-link:hover {
    color: #646464;
}
</style>

@section('body')
    <section class="login-wrapper">
        <div class="container-fluid p-0">
            <div class="row m-0 justify-content-center">
                <div class="col-xl-12 p-0 col-lg-12 col-sm-12 col-12">
                <div class="{{ $auth_type ?? 'login' }}-box">

{{-- Logo --}}


{{-- Card Box --}}
<div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

<div class="{{ $auth_type ?? 'login' }}-logo">
    <a href="/">
        <img src="{{ asset(config('adminlte.logo_img')) }}">
        {{-- {!! config('adminlte.logo', '<b>Admin</b>LTE') !!} --}}
    </a>
</div>
    {{-- Card Header --}}
    @hasSection('auth_header')
        <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
            <h4 class="card-title text-left m-0 text-center">
                @yield('auth_header')
            </h4>
        </div>
    @endif

    {{-- Card Body --}}
    <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
        @yield('auth_body')
    </div>

    {{-- Card Footer --}}
    @hasSection('auth_footer')
        <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
            @yield('auth_footer')
        </div>
    @endif

</div>

</div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
