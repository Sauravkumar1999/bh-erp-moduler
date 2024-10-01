@extends('layouts.landing-layout', ['title' => '“My HUB” 앱 설치 > My HUB'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/greetings.css') }}">
    <link rel="stylesheet" href="{{ themes('css/installApp.css') }}">
    <link rel="stylesheet" href="{{ themes('css/bh-header.css') }}">
    <link rel="stylesheet" href="{{ themes('css/bh-footer.css') }}">
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "MY HUB &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;“My HUB” 앱 설치"])
    @include('layouts.landing-my-hub-dropdown-tabs')

    <div class="install-app-container">
        <div class="heading">
            <h3><b>“My HUB” 앱 설치</b></h3>
        </div>
        <div class="my-hub-logo-info">
            <div class="picture-data">
                <img src="{{ themes('images/process-pic4.png') }}" alt="image">
                <h6 class="orange-title"><b>개인 맞춤형 멀티 세일즈 플랫폼</b></h6>
                <h6>My 앱, 홈페이지에서 내 마음대로 세일즈</h6>
            </div>
            <div class="btn-container">
                <button class="btn btn-light-oranger">
                    우수 세일즈 아이템들을 한 곳에 모았다
                </button>
                <button class="btn btn-light-oranger">
                    My 홈페이지에서 내가 원하는 대로
                </button>
                <button class="btn btn-light-oranger">
                    No 자본, No 출근,  No 재고부담
                </button>
            </div>
        </div>
        <div class="qr-install-container">
            <div class="heading">
                <h3><b>앱 다운로드 방법</b></h3>
                <p class="para">
                    스토어 링크로 접속 또는 QR 코드를 스캔하세요
                </p>
            </div>
            <div class="install-app-content">
                {{-- <div class="left-mobile-pic">
                    <img src="{{ themes('images/install-phone.png') }}" alt="image">
                </div> --}}
                <div class="right-download">
                    <div class="button">
                        <button type="button" class="btn btn-secondary" id="button-1">
                            <h6><img src="{{ themes('images/playstore-logo.png') }}">
                                &nbsp; 다운로드 하러가기</h6>
                        </button>
                        <button type="button" class="btn btn-secondary" id="button-2">
                            <h6><img src="{{ themes('images/apple-logo.png') }}">
                                &nbsp; 다운로드 하러가기</h6>
                        </button>
                    </div>
                </div>
                <div class="qr-img-container">
                    <img src="{{ themes('images/QRcode.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
        function showAlert() {
            Swal.fire({
                text: "준비중입니다",
                icon: "info"
            });
        }
        const items = document.querySelectorAll('.right-download');
        items.forEach(item => {
            item.addEventListener('click', showAlert);
        });
    </script>
</script>
@endpush
