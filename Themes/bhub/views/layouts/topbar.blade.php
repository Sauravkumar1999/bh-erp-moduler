

<style>
    .mobile__header {
        background: #FFF;
        box-shadow: 0px 0px 4px 0px rgba(66, 66, 66, 0.10);
        margin: 0 0 20px;
    }

    .mobile__header .navbar-toggler {
        border: none;
        padding: 0;
    }

    .mobile__header .navbar-toggler:focus,
    .mobile__header .offcanvas-header .btn-close {
        box-shadow: none;
        outline: none;
    }

    .mobile__header .offcanvas-start {
        width: 100%;
        border: none !important;
    }

    .mobile__header .offcanvas-header {
        box-shadow: 0px 0px 4px 0px #4242421A;
    }

    .mobile__header .offcanvas-body ul {
        display: inline-flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
        list-style: none;
        padding: 2.3rem 1rem;
        width: 100%;
        margin: 0 !important;
    }

    .mobile__header .offcanvas-body ul li {
        color: #373737;
        font-family: Pretendard;
        font-size: 16px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
    }

    .mobile__header .offcanvas-body ul li a {
        text-decoration: none;
    }

    .mobile-menu-bottom-section {
        padding: 2.3rem 1rem;
        border-top: 1px solid #D9D9D9;
    }

    .mobile-sidebar-frame-outer {
        display: flex;
        flex-direction: column;
        gap: 40px;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .mobile-sidebar-frame-outer-upper {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .mobile-sidebar-frame-outer-upper>* {
        padding: 12px 16px 12px 16px;
        border-radius: 6px;
        background: #FAFAFA;
        display: block;
        width: 100%;
        font-family: Pretendard;
        font-size: 16px;
        font-weight: 400;
        line-height: 19.09px;
        color: #373737;
        margin: 0 !important;
    }

    .mobile-sidebar-frame-outer-lower {
        display: flex;
        flex-direction: column;
        gap: 40px;
        width: 100%;
    }

    .mobile-sidebar-frame-outer-lower--header .clipboard-copy {
        padding: 10px 30px;
        font-family: Pretendard;
        font-size: 16px;
        font-weight: 500;
        line-height: 19.09px;
        text-align: left;
    }

    .mobile-social-media-icons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .mobile-social-media-icons>* {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        overflow: hidden;
    }

    .mobile-social-media-icons>* img {
        width: 100%;
        height: 100%;
    }

    .sales-person-image {
        height: 30px;
    }
</style>



<nav class="navbar bg-body-tertiary d-md-none navbar mobile__header">
    <div class="container-fluid">
        @if (isset($userSettings) && (!$userSettings->image_register && !$userSettings->text_register))
            <a class="navbar-brand" href="#">
                <img src="{{ themes('images/myhublogo.png') }}" alt="Myhub" />
            </a>
        @else
            <div>
                <a class="navbar-brand d-flex justify-content-center gap-1 mt-2 mb-0" href="#">
                    @if (isset($userSettings) && $userSettings->image_register)
                        <img src="{{ $user->salesPersonImage() }}" alt="Myhub" class="sales-person-image" />
                    @endif
                    @if (isset($userSettings) && $userSettings->text_register)
                        <p class="mt-1">{{ $userSettings->text_registration }}</p>
                    @endif
                </a>
            </div>
        @endif
        <div class="mobile-navbar-sales">
            @if (isset($userSettings))
                <a>{{ $userSettings->telephone }}</a>
            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <img src="{{ themes('images/menu.svg') }}" alt="Menu" />
            </button>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="font-size: medium;">
                    @if (isset($settings->image_register) && $settings->image_register == '1')
                        <img src="{{ $user->salesPersonImage() }}" style="vertical-align: bottom; height: 30px;"
                            alt="salesPersonImage">
                    @endif
                    @if (isset($settings->text_register) && $settings->text_register == '1')
                        {{ $settings->text_registration }}
                    @endif
                    @if (isset($settings->image_register) &&
                            isset($settings->text_register) &&
                            $settings->image_register == '0' &&
                            $settings->text_register == '0')
                        <img src="{{ themes('images/myhublogo.png') }}" alt="salesPersonImage" class="img-fluid">
                    @endif

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul>
                    <li><a href="{{ route('sales.page', $user->code) }}">홈</a></li>
                    @if(Auth::check())
                        @if (auth()->user())
                            <li><a href="{{ route('admin.my-info.manage', $user->id) }}">
                        마이페이지</a></li>
                        @endif
                    @endif
                    <li style="display: none"><a href="{{ route('my-portfolio.view', $user->code) }}">마이 포트폴리오</a></li>
                    <li><a href="{{ route('home') }}">Biz HUB 홈페이지 <svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M17 7L7 17" stroke="#6D6D6D" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M8 7H17V16" stroke="#6D6D6D" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg></a></li>
                </ul>
                <div class="mobile-menu-bottom-section">
                    <div class="mobile-sidebar-frame-outer">
                        <div class="mobile-sidebar-frame-outer-upper">
                            <p>{{ isset($settings->telephone) ? $settings->telephone : '' }}</p>
                            <p>{{ isset($settings->email) ? $settings->email : '' }}</p>
                            <a class="portfolio-link" href="{{ route('my-portfolio.view', $user->code) }}">My 포트폴리오</a>
                        </div>

                        <div class="mobile-sidebar-frame-outer-lower">
                            <div class="mobile-sidebar-frame-outer-lower--header">
                                <div class="row">
                                    <div class="col-xs-12" style="margin-bottom: 10px;">
                                        {!! QrCode::size(80)->generate(route('sales.page', $user->code)) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" class="btn btn-secondary clipboard-copy"
                                            data-clipboard-text="{{ route('sales.page', $user->code) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            data-bs-tFitle="링크가 복사되었습니다." data-bs-trigger="manual">
                                            홈피주소 복사
                                        </button>
                                    </div>
                                </div>

                                @if(Auth::check())
                                    <div class="button mt-3">
                                        <form id="logout-form" action="{{ $logout_url }}" method="POST">
                                            @if(config('adminlte.logout_method'))
                                                {{ method_field(config('adminlte.logout_method')) }}
                                            @endif
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-secondary clipboard-copy"><i class="ti ti-logout me-2 ti-sm  d-none"></i>
                                                <span class="align-middle">{{ __('user::top.logout') }}</span></button>
                                        </form>
                                    </div>

                                @else
                                    <div class="row mt-3">
                                        <div class="col-xs-12">
                                            <button type="button" class="btn btn-secondary clipboard-copy" onclick="location.href='{{ route('login') }}'">
                                                {{ __('user::top.login') }}
                                            </button>
                                        </div>
                                    </div>
                                @endif



                            </div>
                            @php
                                $snsData = isset($settings->sns) ? json_decode($settings->sns) : null;
                            @endphp
                            <div class="mobile-social-media-icons">
                                @if (empty($snsData))
                                @else
                                    @if ($snsData->facebook->status == '1')
                                        <a href="{{ $snsData->facebook->url }}"><img
                                                src="{{ themes('images/facebook.png') }}" class="rounded-circle"
                                                alt="Facebook" /></a>
                                    @endif
                                    @if ($snsData->instagram->status == '1')
                                        <a href="{{ $snsData->instagram->url }}"><img
                                                src="{{ themes('images/instagram.png') }}" class="rounded-circle"
                                                alt="Instagram" /></a>
                                    @endif
                                    @if ($snsData->kakaotalk->status == '1')
                                        <a href="{{ $snsData->kakaotalk->url }}"><img
                                                src="{{ themes('images/talk.png') }}" class="rounded-circle"
                                                alt="Talk" /></a>
                                    @endif
                                    @if ($snsData->blog->status == '1')
                                        <a href="{{ $snsData->blog->url }}"><img src="{{ themes('images/blog.png') }}"
                                                class="rounded-circle" alt="Blog" /></a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
