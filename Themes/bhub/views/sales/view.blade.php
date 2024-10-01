@php($title = isset($userSettings->text_register) && $userSettings->text_register == '1' ? $userSettings->text_registration : trans('user::sale.sales-person'))

@extends('layouts.master',['title' => $title])

<style>
    .card__wrapper {
        position: relative;
    }

    .card__wrapper .share-icon {
        position: absolute;
        top: 10px;
        right: 5px;
    }

    .card__wrapper .card .card-detail-container .card-image {
        height: 140px !important;
    }

    .card__wrapper .card .card-detail-container .card-image .card-img-top {
        width: 140px !important;
        height: 140px !important;
    }

    .margin_bottom {
        margin-bottom: 30px !important;
    }

    /* custom-card-css-start */

    .cus__card {
        width: 100%;
        border-top: 5px solid #EC661A;
        position: relative;
        height: 100%;
        box-shadow: 0px 4px 8px 0px #00000014;
    }

    .cus__card .cus__card__image {
        width: 100%;
        height: 212px;
    }

    .cus__card .cus__card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0 !important;
    }

    .cus__card .cus__card__body {
        padding: 20px;
        position: relative;
    }

    .cus__card .cus__card__body .cus__card__title {
        font-family: Pretendard;
        font-size: 24px;
        font-weight: 700;
        line-height: 28.64px;
        text-align: left;
        color: #EC661A;
        margin: 0 0 12px;
    }

    .cus__card .cus__card__body .cus__card__text {
        font-family: Pretendard;
        font-size: 18px;
        font-weight: 400;
        line-height: 24px;
        text-align: left;
        color: #373737;
        margin: 0;
    }

    .cus__card .share__icon {
        position: absolute;
        top: 12%;
        right: 0;
    }
    @media screen and (max-width: 1024px){
        .cus__card .share__icon{
            top: 0%;
        }
    }
    a.cus__card {
        text-decoration: none;
    }

    @media(max-width:640px) {
        .mobile-text-center {
            display: none !important;
        }

        .cus__card .cus__card__image {
            height: fit-content;
        }

        .cus__card .cus__card__body {
            padding: 15px;
        }

        .cus__card .cus__card__body .cus__card__title {
            font-size: 12px !important;
            line-height: 14px !important;
        }

        .cus__card .cus__card__body .cus__card__text {
            font-size: 11px !important;
            line-height: 13px !important;
        }
    }

    /* custom-card-css-end */
    /* swal */
    .rental-mall-card-title{
            font-size: 22px;
            margin: 0 auto !important;
            padding-left: 0;
            padding-right: 0;
        }
        .rental-mall-card-btn.btn-primary,
        .rental-mall-card-btn.btn-primary:hover {
            background-color: #FD6F22;
            border: unset;
        }
    </style>
@section('sidebar')
    @include('views.layouts.sidebar', [
        'settings' => $userSettings,
        'user' => $user,
    ])
@endsection

@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

@section('content')
    <div class="container py-md-5 py-3">
        <div class="buttons-container">
            @if (auth()->user())
                <a href="/" class="btn btn-outline-secondary">@lang('user::sale.bizhub-homepage')</a>

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
                <a href="/" class="btn btn-outline-secondary">@lang('user::sale.bizhub-homepage')</a>
                <a href="{{ route('login') }}" class="btn btn-secondary">{{ __('user::top.login') }}</a>
            @endif
        </div>
        <h1 class="text-left mobile-text-center margin_bottom">@lang('user::sale.my-services')</h1>
        <div class="row">
            @foreach ($userProducts as $item)
                {{-- @if ($item['exposure']) --}}
                    <div class="col-md-4 col-sm-6 col-6 p-2">
                        @include('views.sales._card', ['item' => $item])
                    </div>
                {{-- @endif --}}
            @endforeach
        </div>
    </div>
@endsection

@push('script')
    <script>
        const clipboardItem = new ClipboardJS('.clipboard-copy-item');
        $('.clipboard-copy-item').on('click', function(e) {
            e.preventDefault();
            $(this).tooltip('hide').tooltip('show');
            setTimeout(function() {
                $('.clipboard-copy-item').tooltip('hide');
            }, 1000);
        });
        @if (setting('rental_mall_enabled', 1))
        $( document ).ready(function() {
            $(document).on('click','.rental_mall_card',function(e){
                e.preventDefault();
                Swal.fire({
                    title: "{{trans('sale::sale.rental-mall-services-text')}}",
                    icon: "info",
                    customClass: {
                        title: 'rental-mall-card-title',
                        confirmButton: 'btn btn-primary waves-effect waves-light rental-mall-card-btn',
                    }
                });
                return;
            })
        });
        @endif

    </script>
@endpush
