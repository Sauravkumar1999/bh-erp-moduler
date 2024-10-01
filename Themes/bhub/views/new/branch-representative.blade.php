@extends('layouts.landing-layout', ['title' => '지사대표(BP)란? > My HUB'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/greetings.css') }}">
    <link rel="stylesheet" href="{{ themes('css/branch-representative.css') }}">
@endpush
@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "MY HUB &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;지사대표(BP)란?"])
    @include('layouts.landing-my-hub-dropdown-tabs')
    <div class="branch-main-container">
        <div class="heading">
            <h3><b>지사대표(BP)란?</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
        </div>
        <div class="branch-content">
            <div class="left-image">
                <img src="{{ themes('images/branch-rep.png') }}" alt="image">
            </div>
            <div class="right-content">
                <h5><b>‘지사대표’(Biz Planner)</b>는,</h5>
                <h6><b>회사에서 제휴된 영업 아이템들을 고객과 매칭하는 세일즈 프리랜서를 지칭</b>합니다.<br />
                    ‘지사대표’<b>는 만19세 이상의 성인</b>인 경우 누구나 등록이 가능하며, 별도의 사업자 등록이나 다른
                    기준을 요구하지 않습니다. ‘지사대표’는, 본인의 지사대표 등록 신청 과정과 회사의 최종 승인
                    과정을 거쳐 최종 등록이 완료됩니다.</h6>
                <h6>최종 등록된, ‘지사대표’는 본인 고유의 홈페이지를 분양 받게 되며, 본인이 원하는 세일즈 목표에 맞게 브랜드 수정과 세일즈 아이템 배열을 수정할 수 있습니다. <b>세일즈
                        경험이 없다 하더라도,</b>
                    대부분의 세일즈 아이템 판매 진행은 온라인으로 쉽게 진행되거나, 전문성이 필요한 경우, 본사 또는 해당 제휴사 전문가가 진행하기 때문에 <b>누구나 쉽게 비즈니스를 할 수
                        있습니다.</b>
                    이렇게 타인의 지원을 받는 경우라도, 본인 커미션 (영업 수수료)는 정해진 규정에 의거하 100% 그대로 지급됩니다.</h6>
                <h6><b>세일즈 경험자 또는 종사자라면,</b> 최근 여러 아이템을 통한 수익 증대와 매출 안정성 확보를 위해 다양한 아이템 보유를 원하고 있으므로 이런 분들은 <b>더욱 높고
                        지속적인 성과를 낼 가능성이
                        높습니다.</b></h6>
                <h6><b>지사대표(BP) 수입은 한계가 없습니다.</b> 또한 수수료 지급을 위한 별도의 영업 성과 또는 인원
                    등록 등 별도 요구가 없습니다. 다만, 행정 편의를 위해 적립된 수수료는 최저 3만원 이상일 경우 지급됩니다. (소멸되지 않고 계속 유지 후,
                    이상 적립시 지급) 일부 아이템의 경우는 1회 계약으로 매월 지속적 수수료가 발생되어 높은 수익 모델을 만들 수 있습니다. 좋은 성과, 즉 세일즈 증진과 본인의 추천인이
                    많은 경우,
                    <b>본부대표(MD)로서 승진 기회가 주어집니다.</b>
                </h6>
            </div>
        </div>
    </div>
@endsection
