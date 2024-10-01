@extends('layouts.landing-layout', ['title' => '지사대표 등록과정 > My HUB'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/greetings.css') }}">
    <link rel="stylesheet" href="{{ themes('css/registration-process.css') }}">
    <link rel="stylesheet" href="{{ themes('css/bh-header') }}.css">
    <link rel="stylesheet" href="{{ themes('css/bh-footer') }}.css">
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "MY HUB &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;지사대표 등록과정"])
    @include('layouts.landing-my-hub-dropdown-tabs')
    <div class="registration-process-content">
        <div class="list-rr text-center">
            <h3><b>지사대표 등록 요건</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-1 col-md-4"></div>
                    <div class="col-10 col-md-4">
                        <ul class="text-start mt-4 mb-5">
                            <li class="mb-3">대상 : <span>만 19세 이상</span></li>
                            <li class="mb-3">자격 : <span>본사로부터 최종 승인을 받은 자</span></li>
                            <li class="mb-3">구분 : <span>프리랜서 (소득세 3% 적용)</span></li>
                            <li class="mb-3"><span>별도의 “사업자 등록” 필요 없음 / 기존 직업 무관</span></li>
                        </ul>
                    </div>
                    <div class="col-1 col-md-4"></div>
                </div>
            </div>
        </div>
        <div class="heading">
            <h3><b>지사대표 등록과정</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
        </div>
        <div class="process-main-content">
            <div class="picture-data">
                <img src="{{ themes('images/process-pic1.png') }}" alt="image">
                <h6><b>지사대표 등록 신청</b></h6>
                <h6>(온라인)</h6>
            </div>
            <div class="picture-data-next">
                <img src="{{ themes('images/process-next.png') }}" alt="">
            </div>

            <div class="picture-data">
                <img src="{{ themes('images/process-pic2.png') }}" alt="image">
                <h6><b>본사 검토</b></h6>
                <h6>(영업일 D+1~2일)</h6>
            </div>
            <div class="picture-data-next">
                <img src="{{ themes('images/process-next.png') }}" alt="">
            </div>

            <div class="picture-data">
                <img src="{{ themes('images/process-pic3.png') }}" alt="image">
                <h6><b>본사 승인</b></h6>
                <h6>(영업일 D+1~3일) <br />
                    상세 안내문 문자 발송</h6>
            </div>
            <div class="picture-data-next">
                <img src="{{ themes('images/process-next.png') }}" alt="">
            </div>

            <div class="picture-data">
                <img src="{{ themes('images/process-pic4.png') }}" alt="image">
                <h6><b>앱 설치 후<br />
                        비즈니스 시작</b></h6>
                <h6>(총 소요 : 평균 1~3일)</h6>
            </div>
        </div>
        <div class="heading">
            <h3><b>본부대표(MD)란?</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
        </div>
        <div class="process-bottom-content mb-4">
            <div class="left-image">
                <img src="{{ themes('images/process-man.png') }}" alt="image">
            </div>
            <div class="process-content-box">
                <h6>본부대표(MD)는 일정 인원 수 이상의 지사대표(BP)들의 세일즈 관리, 인사 관리 등을 업무를 하는 대표자를 말합니다. 본부대표는 <b>본부대표 수수료 기준을 적용</b> 받습니다.
                본부대표 자격 심사를 위해 업무 역량 및 성과 등 별도의 평가 과정에 통과 시 위임됩니다. <b>본부대표(MD) 위임에 별도 비용 (등록비, 보증금 등)은 일체 요청하지 않습니다.</b></h6>
            </div>
        </div>
    </div>
@endsection
