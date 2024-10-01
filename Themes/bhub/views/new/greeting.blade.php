@extends('layouts.landing-layout', ['title' => '인사말 > My HUB'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/greetings.css') }}">
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "MY HUB &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;인사말"])
    @include('layouts.landing-my-hub-dropdown-tabs')
    <div class="main-body-content">
        <div class="heading">
            <h3><b>인사말</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
            <div class="picture">
                <img src="{{ themes('images/greetings.png') }}" alt="image">
            </div>
            <div class="written-content">
                <div class="details">
                    <p><b>“My HUB”</b></p>
                    <h5><b>대한민국 최고의 멀티 세일즈 플랫폼으로 도약하겠습니다.</b></h5>
                    <p class="second-section">안녕하세요? “My HUB“를 방문해 주신 모든 분들께 환영과 감사의 말씀 드립니다.</p>
                    <h6>“My HUB”는 ㈜비즈니스허브의 개인 맞춤형 멀티 세일즈 플랫폼의 이름입니다.
                        <br class="d-md-none d-block">
                        “My HUB”는 높은 경쟁력의 영업 아이템들을 한 곳에 모아 고객이 원하는 아이템을
                        구입할 뿐 아니라, 영업자 본인의 컨셉과 환경에 따라 영업자 본인이 아이템과 브랜드를
                        나의 마음대로 수정할 수 있습니다.
                        <br class="d-md-none d-block">
                        그러므로 영업자는 외부환경에 따른 리스크를 최소화할 수 있을 뿐 아니라, 마켓에서의
                        베스트 셀링 상품으로 바로 반영하여, 영업자는 지속적으로 높은 수익을 실현할 수 있습니다.</h6>
                    <h6>“My HUB”는 수많은 영업 현장 경험에서 시작하였으며, 의지와 열정만 있다면 영업을 매우
                        쉽게 시작하여, 나아가 영업 전문가로서 보다 나은 삶을 성취하는 지사대표님들이 되는,
                        선도적 기업이 될 것을 약속합니다.</h6>
                    <p class="my-hub-section">㈜비즈니스허브 (My HUB) <b>임직원 일동</b></p>
                </div>

            </div>
        </div>

    </div>
@endsection
