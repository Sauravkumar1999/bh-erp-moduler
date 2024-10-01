@php($title = isset($userSettings->text_register) && $userSettings->text_register == '1' ? $userSettings->text_registration : trans('user::sale.sales-person'))
@extends('layouts.master',['title' => $title])

{{-- @dd($user) --}}
@section('sidebar')
@include('views.layouts.sidebar', [
'settings' => $userSettings,
'user' => $user,
])
@endsection


@php( $logout_url = $logout_url ?? route(config('adminlte.logout_url', 'logout')))

@section('content')
<style>
    .badge__tag {
        padding: 16px 20px !important;
        text-align: left;
        color: #373737;
        border-radius: 8px;
        background: rgba(236, 102, 26, 0.05) !important;
    }

    .portfolio-text {
        font-family: Pretendard;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
        color: #373737;
    }
    @media  screen and (max-width:768px) {
        .portfolio-heading{
        text-align: center;
    }
    }
</style>
<div class="container py-5">
    <div class="buttons-container">
        <a href="/" class="btn btn-outline-secondary">@lang('user::sale.bizhub-homepage')</a>
        @if (auth()->user())
            <a href="{{ route('admin.my-info.edit', ['user' => auth()->user()]) }}" class="btn btn-secondary">@lang('user::sale.my-page')</a>
            <a class="btn btn-secondary">
                <form id="logout-form" action="{{ $logout_url }}" method="POST">
                    @if(config('adminlte.logout_method'))
                        {{ method_field(config('adminlte.logout_method')) }}
                    @endif
                    {{ csrf_field() }}
                    <button type="submit" class="btn" style="color: #fff; padding: 0px;"><i class="ti ti-logout me-2 ti-sm d-none"></i>
                        <span class="align-middle">{{ __('user::top.logout') }}</span></button>
                </form>
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('user::top.login') }}</a>
        @endif
    </div>
    <div class="portfolio-heading">
        <p>반갑습니다!</p>
        <h1 class="text-left m-0">{{ $user?->first_name }} {{ $user?->last_name }}</h1>
    </div>

    <div class="mt-3 border-t">
        <div class="card w-100 h-auto m-0">
            <div class="card-body portfolio-text">
                {!! $userSettings?->portfolio !!}
            </div>
        </div>
        <div class="mt-3">
            <span class="badge text-dark badge__tag" style="line-height: 17px; background: rgb(230, 197, 184)">
                휴대폰 번호<br> <b>{{ $userSettings?->telephone }}</b>
            </span>
            <span class="badge text-dark badge__tag" style="line-height: 17px; background: rgb(230, 197, 184)">
                이메일<br> <b>{{ $userSettings?->email }}</b>
            </span>
        </div>
    </div>
    <div class="text-center">
        <button type="button" onclick="return window.location.href='{{ route('sales.page', Request::segment(2)) }}'" class="btn btn-secondary">
            상품 보러가기
        </button>

    </div>
</div>
@endsection

@push('script')
<script></script>
@endpush
