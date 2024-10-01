@extends('layouts.landing-layout', ['title' => 'My 아카데미'])
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/academy.css') }}">

    <style>

    </style>
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => 'My 아카데미'])
    <div class="middle-conent">
        <h2>My 아카데미?</h2>
        <div class="line">
            <img src="{{ themes('images/line-1.png') }}">
        </div>
        <div class="main-image">
            <img src="{{ themes('images/academy-image.png') }}" alt="academy-image">
        </div>
        <div class="text-container-1">
            <h5>세일즈는 어렵다?</h5>
            <h5>세일즈는 타고 나는 것이다?</h5>
            <h5>의지는 있는데 어떻게 할 지 잘 모르겠다?</h5>
        </div>
        <div class="text-container-2">
            <h3><b>“My 아카데미”에 그 해답이 있습니다.</b></h3>
            <h5>My 아카데미는 다양한 세일즈 아이템들의 특징과 셀링 포인트를 잘 요약하여</h5>
            <h5><b>초보자도 쉽게 세일즈 할 수 있도록 만든 “지사대표 전용, 스마트폰 학습 플랫폼“ 입니다.</b></h5>
        </div>



        <div class="text-container-3">
            {{-- <div class="line">
            <img src="{{ themes('images/line-1.png') }}">
            </div> --}}
            <div class="button">
                <button type="button" onclick="showAlert()" class="btn btn-primary"><b>My 아카데미 입장</b></button>
            </div>

            <h5>※ 지사대표(BP) 최종 등록 완료 시 입장 가능</h5>
        </div>


        <div class="text-container-middle">
            <h2>My 아카데미!</h2>
            <div class="line">
                <img src="{{ themes('images/line-1.png') }}">
            </div>

            <img class="hand" src="{{ themes('images/hand.png') }}">
        </div>
        <div class="text-container-4">
            <div class="picture">
                <img src="{{ themes('images/man.png') }}" alt="man-image">
            </div>
            <div class="all-text">
                <h5><img src="{{ themes('images/one.png') }}">&nbsp;<b>세일즈의 고수들이 직접 만든 실전 노하우 자료</b>
                </h5>
                <h6><img src="{{ themes('images/points.png') }}">&nbsp; 실제 고객과의 상담 화법 자료 / 동영상 등</h6>
                <h6><img src="{{ themes('images/points.png') }}">&nbsp;각 세일즈 아이템별 제휴사 세일즈 자료 모음</h6>
            </div>
        </div>
        <div class="text-container-5">
            <div class="picture">
                <img src="{{ themes('images/goal.png') }}" alt="goal-image">
            </div>
            <div class="all-text">
                <h5><img src="{{ themes('images/two.png') }}">&nbsp;<b>딱 필요한 주제들을 잘라서 약 1~2분 교육 자료
                        편성</b>
                </h5>
                <h6><img src="{{ themes('images/points.png') }}">&nbsp;짧게 상황별, 주제별 동영상 또는 문서 자료</h6>
                <h6><img src="{{ themes('images/points.png') }}">&nbsp;불필요하게 전체를 보거나 찾지 않아도 됩니다.</h6>
            </div>
        </div>
        <div class="text-container-6">
            <div class="picture">
                <img src="{{ themes('images/mobile.png') }}" alt="mobile-image">
            </div>
            <div class="all-text">
                <h5><img src="{{ themes('images/three.png') }}"> &nbsp; <b>나의 실전 마케팅 자료까지 제작해 드리는 “맞춤형
                        마케팅
                        지원＂</b></h5>
                <h6><img src="{{ themes('images/points.png') }}">&nbsp;예쁘게 디자인한 상품 SNS 리플릿 등 다양한 세일즈 자료
                    제작
                </h6>
                <h6><img src="{{ themes('images/points.png') }}">&nbsp;지사대표 본인 브랜드 및 연락처가 들어가도록 개별 제작 지원
                </h6>
            </div>
        </div>
    </div>
    <div class="below-container">
        <div class="text-content">
            <h6><b>지사대표 신청하러 가기!</b></h6>
            <h5>지사대표가 되시면 <b>“My 아카데미”</b>를 사용할 수 있습니다.</h5>
            <div class="button">
                <button type="button" onclick="return window.location.href=('{{ route('recruitment-representatives.view')}}')" class="btn btn-primary" id="button-academy"><b>지사대표 신청하기</b></button>
            </div>
        </div>
        <div class="image-box">
            <img src="{{ themes('images/men.png') }}" alt="men-image">
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function showAlert() {
            Swal.fire({
                html: '<div class="py-3">준비중</div>',
                icon: "info"
            });
        }
    </script>
@endpush
