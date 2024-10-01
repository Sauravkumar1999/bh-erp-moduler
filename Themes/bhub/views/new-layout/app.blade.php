<!DOCTYPE html>
<html lang="ko">

<head>
    @include('views.google-tags.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/bh-header.css') }}">
    <link rel="stylesheet" href="{{ themes('css/bh-footer.css') }}">
    {!! get_meta_data() !!}
    @stack('css')
</head>

<body>
    @include('views.google-tags.body')
    <div id="header-container"></div>
    <main>
        <div class="below-header">
            <div class="options-left">
                <h6><img src="{{ themes('images/home.png') }}" alt="home-icon"> &nbsp;
                    <img src="{{ themes('images/next-icon.png') }}">&nbsp;
                    My HUB &nbsp;
                    <img src="{{ themes('images/next-icon.png') }}">&nbsp;
                    인사말
                </h6>
            </div>
        </div>
        <div class="dropdown-pages-tab">
            <a href="{{ route('greeting') }}" @if (Request::is('greeting')) class="activeclass" @endif>인사말</a>
            <a href="{{ route('business-model') }}" @if (Request::is('business-model')) class="activeclass" @endif>비즈니스
                모델</a>
            <a href="{{ route('competitiveness') }}" @if (Request::is('competitiveness')) class="activeclass" @endif>“My
                HUB” 경쟁력</a>
            <a href="{{ route('branch-representative') }}"
                @if (Request::is('branch-representative')) class="activeclass" @endif>지사대표(BP)란?</a>
            <a href="{{ route('representative-registration') }}"
                @if (Request::is('representative-registration')) class="activeclass" @endif>지사대표 등록과정</a>
            <a href="{{ route('compensation') }}" @if (Request::is('compensation')) class="activeclass" @endif>구조 및
                보상</a>
            <a href="{{ route('install-app') }}" @if (Request::is('install-app')) class="activeclass" @endif>“My HUB”
                앱 설치</a>
        </div>
        @yield('main')

    </main>
    <div id="header-container">
        @include('views.layouts.landing-footer')
    </div>
    <script src="{{ themes('js/BH-footer.js') }}"></script>
    <script>
        
        // Define the header component
        const headerComponent = `
    <div class = "header">
        <div class="first-container">
            <h6><img src="{{ themes('images/cell-icon.png') }}" /> {{ setting('bh_telephone', '') }}</h6>
        </div>
        <div class="navbar">
            <div class="navbar-container">
                <div class="second-container">
                    <div class="logo">
                        <a href="{{url('/')}}"><img src="{{ themes('images/myhublogo.png') }}"
                            alt="48pay-logo" /></a>
                    </div>

                    <div class="content-middle">
                        <div class="dropdown">
                            <h5>My HUB<img src="{{ themes('images/keydown.png') }}"></h5>
                            <div class="dropdown-content">
                            <h6>인사말</h6>
                            <h6>비즈니스 모델</h6>
                            <h6>“My HUB” 경쟁력</h6>
                            <h6>지사대표(BP)란?</h6>
                            <h6>지사대표 등록과정</h6>
                            <h6>구조 및 보상</h6>
                            <h6>“My HUB” 앱 설치</h6>
                            </div>
                        </div>
                        <div class="col-b" id="tab-2"><a href="{{route('sales.item-listing')}}"><h5>세일즈 아이템</h5></a></div>
                        <div class="col-c" id="tab-3"><a href="{{route('academy.view')}}"><h5>My 아카데미</h5></a></div>
                        <div class="col-d" id="tab-4"><h5>고객센터<img src="{{ themes('images/keydown.png') }}"></h5></div>
                        <div class="col-e" id="tab-5"><a href="{{route('recruitment-representatives.view')}}"><h5>지사대표 모집</h5></a></div>
                    </div>

                    <div class="button">
                        <button type="button" class="btn btn-primary" id="button-1" onclick="location.href='{{ route('login') }}'"><b>{{ __('user::top.login') }}</b ></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;
        // Append the header component to the #header-container
        document.getElementById('header-container').innerHTML = headerComponent;
        document.querySelectorAll('.dropdown-content h6').forEach(item => {
            item.addEventListener('click', function() {
                const text = this.textContent.trim();


                switch (text) {
                    case '인사말':
                        window.location.href = '{{ route('greeting') }}';
                        break;
                    case '비즈니스 모델':
                        window.location.href = '{{ route('business-model') }}';
                        break;
                    case '“My HUB” 경쟁력':
                        window.location.href = '{{ route('competitiveness') }}';
                        break;
                    case '지사대표(BP)란?':
                        window.location.href = '{{ route('branch-representative') }}';
                        break;
                    case '지사대표 등록과정':
                        window.location.href = '{{ route('representative-registration') }}';
                        break;
                    case '구조 및 보상':
                        window.location.href = '{{ route('compensation') }}';
                        break;
                    case '“My HUB” 앱 설치':
                        window.location.href = '{{ route('install-app') }}';
                        break;
                    default:
                        window.location.href = '{{ route('greeting') }}';
                        break;
                }
            });
        });
    </script>
</body>

</html>
