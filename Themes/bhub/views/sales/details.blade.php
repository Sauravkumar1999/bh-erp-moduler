<!DOCTYPE html>
<html lang="ko">

<head>
    @include('views.google-tags.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/itemDetails.css') }}">
    <link rel="stylesheet" href="{{ themes('css/bh-header.css') }}">
    <title>Sales Item Details</title>
    {!! get_meta_data() !!}
</head>

<body>
    @include('views.google-tags.body')
    <div id="header-container">
        <div class = "header">
            <div class="first-container">
                <h6><img src="{{ themes('images/cell-icon.png') }}" /> {{ setting('bh_telephone', '') }}</h6>
            </div>
            <div class="navbar">
                <div class="navbar-container">
                    <div class="second-container">
                        <div class="logo">
                            <a href="{{url('/')}}"><img src="{{ themes('images/myhublogo.png') }}" alt="48pay-logo" /></a>
                        </div>
                        <div class="content-middle">
                            <div class="col-a" id="tab-1">
                                <h5>My HUB<img src="{{ themes('images/keydown.png') }}"></h5>
                            </div>
                            <div class="col-b" id="tab-2">
                                <a href="{{route('sales.item-listing')}}"><h5>세일즈 아이템</h5></a>
                            </div>
                            <div class="col-c" id="tab-3">
                                <a href="{{route('academy.view')}}"><h5>My 아카데미</h5></a>
                            </div>
                            <div class="col-d" id="tab-4">
                                <h5>고객센터<img src="{{ themes('images/keydown.png') }}"></h5>
                            </div>
                            <div class="col-e" id="tab-5">
                                <a href="{{route('recruitment-representatives.view')}}"><h5>지사대표 모집</h5></a>
                            </div>
                        </div>

                        <div class="button">
                            <button type="button" class="btn btn-primary" id="button-1" onclick="location.href='{{ route('login') }}'"><b>로그인</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="below-header">
            <div class="options-left">
                <h6><img src="{{ themes('images/home.png') }}" alt="home-icon"> &nbsp;
                    <img src="{{ themes('images/next-icon.png') }}">&nbsp;
                    My HUB &nbsp;
                    <img src="{{ themes('images/next-icon.png') }}">&nbsp;
                    세일즈 아이템 &nbsp;
                    <img src="{{ themes('images/next-icon.png') }}">&nbsp;
                    렌탈
                </h6>
            </div>
        </div>
        <div class="cental-container">
            <h3><b>렌탈</b></h3>
        </div>
        <div class="main-content">
            <div class="detail-container">
                <h5><img src="{{ themes('images/points.png') }}"> &nbsp; 가전 렌탈 회사들을 한 곳에 모았습니다.</h5>
                <h5><img src="{{ themes('images/points.png') }}"> &nbsp; 고객은 비교하고 온라인에서 쉽게 렌탈 할 수 있습니다.</h5>
                <h5><img src="{{ themes('images/points.png') }}"> &nbsp; 지사대표가 되면 “렌탈 창업” 바로 할 수 있습니다.</h5>
            </div>
            <div class="below-detail-container">
                <h4><img src="{{ themes('images/one.png') }}"> &nbsp; 렌탈 창업, 괜찮을까요?</h4>
                <h4><img src="{{ themes('images/two.png') }}"> &nbsp; 렌탈의 장점과 기회</h4>
                <h4><img src="{{ themes('images/three.png') }}"> &nbsp; 무자본 렌탈 창업, 준비와 절차</h4>
                <h4><img src="{{ themes('images/four.png') }}"> &nbsp; 렌탈 업무 진행 예시</h4>
                <h4><img src="{{ themes('images/five.png') }}"> &nbsp; 렌탈 창업 업무 지원</h4>
            </div>
        </div>
    </main>
</body>

</html>
