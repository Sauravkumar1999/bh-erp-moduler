@extends('layouts.landing-layout', ['title' => '“My HUB” 경쟁력 > My HUB'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/greetings.css') }}">
    <link rel="stylesheet" href="{{ themes('css/competitiveness.css') }}">
    <link rel="stylesheet" href="{{ themes('css/businessModel.css') }}">

    <style>
        main {
            min-height: 78vh !important;
        }
    </style>
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "MY HUB &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;“My HUB” 경쟁력"])
    @include('layouts.landing-my-hub-dropdown-tabs')
    <div class="competitive-container">
        <div class="heading">
            <h3><b>“My HUB” 경쟁력</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
        </div>
        <div class="first-content">
            <h5><img src="{{ themes('images/one.png') }}"> &nbsp; <span class="d-block d-md-inline">My 홈페이지에서, My 비즈니스를 만든다</span></h5>
            <div class="first-pictures">
                <div class="picture-data">
                    <img src="{{ themes('images/pic-1.png') }}" alt="image">
                    <h6><b>내 홈피</b></h6>
                    <h6>내맘대로</h6>
                </div>

                <div class="picture-data">
                    <img src="{{ themes('images/pic-2.png') }}" alt="image">
                    <h6><b>브랜드 변경</b></h6>
                    <h6>내맘대로</h6>
                </div>

                <div class="picture-data">
                    <img src="{{ themes('images/pic-3.png') }}" alt="image">
                    <h6><b>아이템 진열</b></h6>
                    <h6>내맘대로</h6>
                </div>

                <div class="picture-data">
                    <img src="{{ themes('images/pic-4.png') }}" alt="image">
                    <h6><b>IT 시스템</b></h6>
                    <h6>ERP 지원</h6>
                </div>
            </div>
            <div class="business-below-content">
                <div class="content">
                    <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 내가 직접 소유하고 내 마음대로 관리하는 개인이 소유하는 홈페이지</h6>
                    <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 나의 홈페이지 이름 (사업체 브랜드 간판) 내 마음대로 변경 가능 (B2B 제휴사는
                        제외)</h6>
                    <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 내가 원하는 영업 아이템을 선별하여 우선순위 노출 / 위치 변경 변경 가능</h6>
                    <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 내가 원하는 신규 영업 아이템이 있다면, 본사 승인 과정을 통해 추가 이익 공유
                        가능</h6>
                    <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 꼭 필요한 비즈니스 전산 시스템 : 인사,매출,수수료 관리 등 지원 시스템</h6>
                </div>
            </div>

            <div class="business-below-content2">
                <div class="content">
                    <img src="{{ themes('images/pic-5.png') }}">
                </div>
            </div>
        </div>
        <div class="second-content">
            <h5><img class="number" src="{{ themes('images/two.png') }}"> &nbsp; <span class="d-block d-md-inline">회사 자체 아이템 + 우수 경쟁력 아이템시장 선도</span>
                <span class="d-block d-md-inline"><img class="arrow" src="{{ themes('images/arrow-next') }}.png"></span> <span class="d-block d-md-inline">시장 차별화</span>
            </h5>

             <div class="second-picture">
                <img class="d-none d-md-block" src="{{ themes('images/market-diff') }}.png" alt="image">
            </div>
            <div class="data-cards">
                <div class="card">
                    <h6>차별성 (Differentiation)</h6>
                </div>
                <div class="card">
                    <h6>우수 기술력 (Superiority)</h6>
                </div>
                <div class="card">
                    <h6>시장 선도 (Market Leader)</h6>
                </div>
                <div class="card">
                    <h6>새로운 수익 (New Profitability)</h6>
                </div>
                <div class="card">
                    <h6>고객 감동 (Customer Orientation)</h6>
                </div>
            </div>

        </div>


        <div class="third-content">
            <div class="third-picture">
                <img class="d-block d-md-none" src="{{ themes('images/logos') }}.png" alt="image">
             </div>

        </div>



    </div>
@endsection

