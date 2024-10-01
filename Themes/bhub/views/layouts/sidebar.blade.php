<style>
    body {
        background-color: #fff;
    }

    .card {
        height: auto !important;
        width: 100% !important;
        box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.08);
    }

    .card-image {
        height: 80px;
        text-align: center;
        margin: 25px 0 0;
    }

    .desktop {
        display: block;
    }

    @media screen and (max-width:768px) {
        .desktop {
            display: none;
        }

        .body__section {
            box-shadow: none !important;
            background: transparent !important;
        }

        .body__section .avatar {
            background: transparent !important;
        }

        .body__section .sidebar-frame-outer-upper {
            width: 100%;
            border-radius: 0px 0px 8px 8px;
            border-top: 5px solid var(--main2, #EC661A);
            background: var(--Neutral-1, #FFF);
            box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.08);
            padding: 0 0 22px;
        }

        .mobile-text-center {
            text-align: center !important;
        }

        .avatar h4:after {
            content: '';
            width: 20px;
            height: 2px;
            background: #fd6f22;
            display: block;
            margin: 20px auto 0;
        }

        header.avatar {
            padding: 20px 0 !important;
        }

        header.avatar img {
            width: 100px !important;
        }

        .social-media-icons img {
            width: 36px;
            height: 36px;
            margin: 10px 2px;
        }

        .card {
            height: auto !important;
            box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.08);
        }

        .card-img-top {
            border-radius: 50px;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin: 0 0 10px;
        }

        .card .share-icon {
            text-align: right;
            position: absolute;
            right: 0;
            top: 10px;
        }

        .card-image {
            height: auto !important;
        }

        .card-content {
            max-height: fit-content !important;
            min-height: fit-content !important;
        }

        main .container .col {
            margin: 20px 0 0;
        }

        a:hover {
            color: #fd6f22 !important;
        }
    }

    .user_badge {
        border-radius: 50px;
        border: 1px solid #ECC440;
        background: #FFF;
        display: flex;
        width: 65px;
        height: 65px;
        padding: 5px 5px 4px 4px;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        margin-bottom: 15px;
    }
</style>

<nav class="menu body__section desktop" tabindex="0">
    <div class="sidebar-frame-outer">
        <div class="sidebar-frame-outer-upper">
            <header class="avatar">
                @if (isset($settings->image_register) && $settings->image_register == '1')
                    <img src="{{ $user->salesPersonImage() }}" alt="salesPersonImage" class="img-fluid">
                @endif
                @if (isset($settings->text_register) && $settings->text_register == '1')
                    <h4>{{ $settings->text_registration }}</h4>
                @endif
                @if (isset($settings->image_register) &&
                        $settings->image_register == '0' &&
                        (isset($settings->text_register) && $settings->text_register == '0'))
                    <img src="{{ themes('images/myhublogo.png') }}" alt="salesPersonImage" class="img-fluid">
                @endif
                @if (!isset($settings->image_register) && !isset($settings->text_register))
                    <img src="{{ themes('images/myhublogo.png') }}" alt="salesPersonImage" class="img-fluid">
                @endif
            </header>
            @if (setting('royal_membership_active', 1) && is_royal_member($user))
                <img class="user_badge" src="{{ themes('images/paid-icon.svg') }}" alt="paid" class="img-fluid">
            @endif
            <p>{{ isset($settings->telephone) ? $settings->telephone : '' }}</p>
            <p>{{ isset($settings->email) ? $settings->email : '' }}</p>
            <a class="portfolio-link" href="{{ route('my-portfolio.view', $user->code) }}">My 포트폴리오</a>
            <style>
                .portfolio-link:hover {
                    color: #fd7e14;
                }
            </style>
        </div>

        <div class="sidebar-frame-outer-lower">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom: 10px;">
                    {!! QrCode::size(80)->generate(sales_person_url($user->code)) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="button" class="btn btn-secondary clipboard-copy"
                        data-clipboard-text="{{ sales_person_url($user->code) }}" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" data-bs-title="링크가 복사되었습니다." data-bs-trigger="manual">
                        홈피주소 복사
                    </button>
                </div>
            </div>
            @php
                $snsData = isset($settings->sns) ? json_decode($settings->sns) : null;
            @endphp
            <div class="social-media-icons">
                @if (empty($snsData))
                @else
                    @if ($snsData->facebook->status == '1')
                        <a href="{{ $snsData->facebook->url }}"><img src="{{ themes('images/facebook.png') }}"
                                class="rounded-circle" alt="Facebook" /></a>
                    @endif
                    @if ($snsData->instagram->status == '1')
                        <a href="{{ $snsData->instagram->url }}"><img src="{{ themes('images/instagram.png') }}"
                                class="rounded-circle" alt="Instagram" /></a>
                    @endif
                    @if ($snsData->kakaotalk->status == '1')
                        <a href="{{ $snsData->kakaotalk->url }}"><img src="{{ themes('images/talk.png') }}"
                                class="rounded-circle" alt="Talk" /></a>
                    @endif
                    @if ($snsData->blog->status == '1')
                        <a href="{{ $snsData->blog->url }}"><img src="{{ themes('images/blog.png') }}"
                                class="rounded-circle" alt="Blog" /></a>
                    @endif
                @endif
            </div>
        </div>


    </div>
</nav>

@push('script')
    <script>
        const clipboard = new ClipboardJS('.clipboard-copy');
        clipboard.on('success', function(e) {
            $('.clipboard-copy').tooltip('hide').tooltip('show');
            setTimeout(function() {
                $('.clipboard-copy').tooltip('hide');
            }, 1000);
            e.clearSelection();
        });
    </script>
@endpush
