@extends('layouts.landing-layout', ['title' => '구조 및 보상 > My HUB'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/greetings.css') }}">
    <link rel="stylesheet" href="{{ themes('css/businessModel.css') }}">
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "MY HUB &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;구조 및 보상"])
    @include('layouts.landing-my-hub-dropdown-tabs')
    <div class="business-model-content">
        <div class="heading">
            <h3><b>구조 및 보상</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
        </div>
        <div class="image">
            <img src="{{ themes('images/structure-picture.png') }}" alt="image">
        </div>
    </div>
    <div class="business-below-content">
        <div class="content">
            <h6><b><img src="{{ themes('images/points.png') }}"> &nbsp; 수수료의 종류</b></h6>
            <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 커미션 : 본인이 직접 영업한 수수료</h6>
            <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 추천 보너스 : 직계 1단계 커미션의 약 30% 보너스 (하위 1단계만 적용 / 상품에
                따라 다소
                상이할 수 있음)</h6>
            <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 예시 본인과 본인이 추천한 직계 1단계의 5명이 모두 100만원의 커미션을 받았다면
            </h6>
            <h6>&nbsp;&nbsp;&nbsp; 본인 커미션 100만원 + 추천보너스 150만원 (100만 x 30% x 5명) = 본인 총 수당 : 250만원</h6>
        </div>
    </div>
@endsection
