@extends('layouts.landing-layout', ['title' => 'Home'])
@push('css')
    <link rel="stylesheet" href="{{ themes('landing/css/bhhome.css') }}">
    <style>
        .dot {
            height: 9px;
            width: 9px;
            background-color: #999898;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.1rem !important;
            margin-left: 0.1rem !important;
            cursor: pointer;
        }

        .col-detail {
            cursor: pointer;
            line-height: 1.3rem;
        }

        .col-detail img {
            padding-bottom: 0.5rem;
        }

        div:where(.swal2-icon) {
            width: 4rem;
            height: 4em;
        }

        div:where(.swal2-container) .swal2-html-container {
            margin: 1em 11.6em 2.3em;

        }

        .activedot {
            width: 20px;
            border-radius: 0.25rem !important;
            background-color: #4f4a4a;

        }

        .custom-slider {
            display: grid;
            justify-items: center;
            margin-top: -12px;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #373737 !important;
        }

        .favorite-menu-title { font-size: 1.2em; }

        @media screen and (max-width:768px) {
            body {
                /* overflow-y: hidden !important; */
            }

            .card {
                width: 80%;
                height: auto;
                margin: auto;
            }

            .flexlayout {
                display: flex;
                justify-content: space-evenly;
                flex-direction: row;
                align-items: center;
                text-align: center;
                /* gap: 20px; */
            }

            .flexlayout .boxes {
                width: 25%;
            }

            .slider-dots {
                /* transform: translate(-50%, -50%) !important; */
                /* left: -15% !important; */
                /* bottom: 0; */
                /* margin-bottom: 0; */
                /* top: 90%; */
                top: 92%;
                position: absolute;
                margin: auto;
            }

            .custom-slider {
                margin-top: 40px;
            }


            .custom-slider .social-media {
                bottom: -2% !important;
                right: 2% !important;
                padding-right: 0px !important;
            }

            .custom-slider .social-media {

                bottom: -2% !important;
                right: 2% !important;
                padding-right: 0px !important;
            }
        }

        .custom-slider {
            position: relative;
        }

        .custom-slider .social-media {
            position: absolute;
            bottom: -2%;
            right: 1.1vw;
            padding-right: 0px;
        }


        @media screen and (max-width: 768px) {

            div:where(.swal2-container) .swal2-html-container {
                margin: 1em 0 2.3em !important;
            }

            .custom-slider .social-media {

                bottom: -2% !important;
                right: 2% !important;
                padding-right: 0px !important;
            }

            .social-media {
                display: none;
            }

            .custom-slider .card {
                /* margin-left: 10px; */
                /* margin-right: 10px; */
                width: 90%;
                margin-top: 10px;
                padding: 20px;
            }

            .flexlayout .col {
                padding-right: 0px;
                padding-left: 0px;
            }

            .col-detail h6 {
                font-size: 14px;
                cursor: pointer !important;
            }
        }

        .flexlayout {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .flexlayout .boxes .col-detail a {
            color: #373737;
            text-decoration: none;
        }

        .flexlayout .boxes .col-detail h6 {
            /* font-weight: 400;
            font-size: 16px;
            line-height: 20px; */
        }

        .card.menu-box-card {
            display: flex;
            width: 876px;
            height: 156px;
            left: unset;
            /* padding: 34px, 80px, 34px, 60px ; */
            border-radius: 20px;
            /* border: 1px ; */
            border: 1px solid rgba(236, 102, 26, 1);
            /* padding: 34px 40px 34px 30px; */
            padding-left: 5em;
            padding-right: 5em;
            margin-top: -78px;
            margin-left: -20px;
            margin-bottom: 60px;
        }

        @media screen and (max-width: 768px) {

            .col-detail {
                line-height: 1.2rem;
                font-size: 0.8rem;
            }

            .custom-slider .card {
                /* margin-left: 10px; */
                /* margin-right: 10px; */
                width: 90% !important;
                margin-top: 10px;
                padding: 20px;
            }

            .custom-slider .card .flexlayout {
                width: 100%;
            }

            .card.menu-box-card {
                padding-left: 1em;
                padding-right: 1em;
            }


        }
    </style>
@endpush
@section('content')
    <div class="body-container">
        {!! Slider::render('landing-page') !!}
        <div style="" class="custom-slider">
            <div class="col d-md-none d-block">
                <div class="left-col-data favorite-menu-title">
                    자주 가는 메뉴 <img src="{{ themes('images/next.png') }}" alt="next" />
                </div>
            </div>
            <div class="card menu-box-card">
                <div class="flexlayout">
                    <div class="d-md-block d-none">
                        <div class="left-col-data favorite-menu-title">
                            자주 가는 메뉴 <img src="{{ themes('images/next.png') }}" alt="next" />
                        </div>
                    </div>

                    <div class="boxes">
                        <div class="col-detail">
                            <a href="{{ route('competitiveness') }}">
                                <img src="{{ themes('images/comp.png') }}" alt="my-sales"><br />
                                My HUB<br />경쟁력
                            </a>
                        </div>
                    </div>
                    <div class="boxes">
                        <div class="col-detail">
                            <a href="{{ route('representative-registration') }}">
                                <img src="{{ themes('images/cycle.png') }}" alt="representative"><br />
                                지사 대표<br />등록 절차
                            </a>
                        </div>
                    </div>
                    <div class="boxes">
                        <div class="col-detail">
                            <a href="{{ route('recruitment-representatives.view') }}">
                                <img src="{{ themes('images/note.png') }}" alt="recruitment"><br />
                                지사 대표<br />모집
                            </a>
                        </div>
                    </div>
                    <div class="boxes">
                        <div class="col-detail">
                            <a href="{{ route('install-app') }}">
                                <img src="{{ themes('images/hub-data.png') }}" alt=""><br />
                                My HUB<br />앱 설치
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social-media">
                <div class="sm-icons">
                    <a href="https://pf.kakao.com/_DTwxcxj" target="_blank"><img src="{{ themes('images/chat-logo.png') }}" alt="chat-icon"></a>
                    <a href="https://blog.naver.com/businesshub1004" target="_blank"><img src="{{ themes('images/blog-logo.png') }}" alt="blog-icon"></a>
                    <a href="https://t.me/+7j8AJ0tiiYc4MGFl" target="_blank"><img src="{{ themes('images/tel-logo.png') }}" alt="tel-icon"></a>
                    <a href="https://www.facebook.com/people/비즈니스허브/100094881106048/" target="_blank"><img src="{{ themes('images/fb-logo.png') }}" alt="fb-icon"></a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
