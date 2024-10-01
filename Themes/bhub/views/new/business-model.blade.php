@extends('layouts.landing-layout', ['title' => '비즈니스 모델 > My HUB'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/greetings.css') }}">
    <link rel="stylesheet" href="{{ themes('css/businessModel.css') }}">
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "MY HUB &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;비즈니스 모델"])
    @include('layouts.landing-my-hub-dropdown-tabs')
    <div class="business-model-content">
        <div class="heading">
            <h3><b>비즈니스 모델</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
        </div>
        <div class="image">
            <img src="{{ themes('images/business_model.svg') }}" alt="image">
        </div>
    </div>
    <div class="business-below-content">
        <div class="business-below-content-container">
            <div class="content">
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 높은 경쟁력의 영업 아이템들을 한 곳에서</h6>
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 고객에게는 합리적 가격과 혜택을</h6>
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 영업자(지사대표)에게는 높은 수익을</h6>
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 영업자 개인 홈페이지 온라인 플랫폼 기반으로 고객, 영업자, 회사 모두가 행복한 비즈니스
                    모델!
                </h6>
            </div>
        </div>
    </div>
@endsection

