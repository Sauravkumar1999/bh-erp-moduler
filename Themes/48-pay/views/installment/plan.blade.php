@extends('layouts.master', ['inquiry_form_link' => route('48-pay.merchant.view')])

@section('title', '48개월 초슬림할부 | Business Hub')

@section('css')
    <link rel="stylesheet" href="{{ themes('css/installment.css') }}">
    <style>
        /* Last image Styles */
        /* @media (min-width: 2100px) {
            .waveform-data-container{
                margin: 0 auto;
                margin-left: 25%;
                margin-right: 135px;
            }
        }
        @media (max-width: 2000px) {
            .waveform-data-container{
                margin: 0 auto;
                margin-left: 18%;
                margin-right: 135px;
            }
        }
        @media (max-width: 1800px) {
            .waveform-data-container{
                margin: 0 auto;
                margin-left: 15%;
                margin-right: 135px;
            }
        }
        @media (max-width: 1600px) {
            .waveform-data-container{
                margin: 0 auto;
                margin-left: 9%;
                margin-right: 135px;
            }
        }
        @media (max-width: 1500px) {
            .waveform-data-container{
                margin: 0 auto;
                margin-left: 7%;
                margin-right: 135px;
            }
        }
        @media (max-width: 1400px) {
            .waveform-data-container{
                margin: 0 auto;
                margin-left: 5%;
                margin-right: 135px;
            }
        }
        @media (max-width: 1300px) {
            .waveform-data-container{
                margin: 0 auto;
                margin-left: 2%;
                margin-right: 135px;
            }
        } */

        .waveform-data-container img
        {
            margin-left: auto;
            margin-right: auto;
            width: 1150px
        }

        .card-waveform{
            margin-left: 34px;
            width: 260px;
            height: 142px;
        }
        .card-waveform-2{
            width: 208px;
            height: 74px;
            margin-left: 48px;
        }

        .waveform-content-text .col-1{
            margin-left: 60px;
        }
        .waveform-content-text .col-2{
            margin-left: -60px;
        }
        .waveform-content-text .col-3{
            margin-left: -145px;
        }
        .waveform-content-text .col-4{
            margin-left: -235px;
        }
        .waveform-content-text .col-5{
            margin-top: -28px;
            margin-left: 195px;
        }
        .waveform-content-text .col-6{
            margin-top: -28px;
            /* margin-left: 810px; */
            text-align: right;
            width: 20%;
        }
        .card-waveform-3{
            margin-left: 54px;
            margin-top: 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .container-div {
            width: 100%; /* Set the width of the container */
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap;
            /* padding: 0px; */
        }

        #footer-container{
            display: none !important;
        }

        .btn-color {
            color: #fff;
        }

        .btn-color {
            background: #EC661A;
            font-size: 16px;
            font-weight: 700;
            font-family: Pretendard;
            /* Moved font-family to here */
            word-wrap: break-word;
        }

        .submit-btn {
            padding: 12px 60px;
        }

        .btn-color:hover {
            color: #fff !important;
        }

    </style>
@stop

@section('content')
    <div class="installment-flex mt-0">
        <div class="flex-content">
            <h3>신한카드 단독 제휴, <span class="d-md-inline d-block">48개월 초슬림 할부 금융 솔루션</span></h3>
        </div>
        <div class="background-bar">
            <img src="{{ themes('images/bar-bg.svg') }}" alt="">
        </div>
    </div>
    <div class="upper-money-cards">
        <div class="money-cards-container">
            <div class="text-above-cards">
                <h3>48개월 초슬림 할부</h3>
            </div>
            <div class="only-cards">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ themes('images/clock.png') }}" alt="clock">
                                <h5>장기 할부</h5>
                                <h4>48개월</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ themes('images/voucher.png') }}" alt="voucher">
                                <h5>카드수수료</h5>
                                <h4>없음</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ themes('images/calender.png') }}" alt="Calender">
                                <h5>월 납입액</h5>
                                <h4>초슬림</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ themes('images/cash.png') }}" alt="Cash">
                                <h5>캐시백</h5>
                                <h4>7%</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-container-data">
                <h4 class="data1">고객의 <b>“할부이자: 0원”</b> (캐시백으로 결제금액의 약 1% 이익)</h4>
                <h4 class="data2">고객 일시불 결제에 따른 <b>자금 부담 해소</b></h4>
                <h4 class="data3"><b>48 Pay 수수료를</b> 마케팅 전략에 따라 <b>탄력적으로 결정 가능</b></h4>
            </div>
            <div class="people-image">
                <img src="{{ themes('images/people.png') }}" alt="People" />
            </div>
        </div>
    </div>
    <div class="lower-cards-container">
        <div class="row">
            <div class="col-md-4 card-items">
                <div class="card-inst">
                    <div class="card-body-inst">
                        <h5 class="numbers"><b>01</b></h5>
                        <h5 class="card-title-inst sub-title1">결제 후 익월 15일 결제금액의</h5>
                        <h5 class="sub-title1"><b>7% 캐시백 지급</b></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 card-items">
                <div class="card-inst">
                    <div class="card-body-inst">
                        <h5 class="linear-text numbers"><b>02</b></h5>
                        <h5 class="card-title-inst sub-title2">1~4회차</h5>
                        <h5 class="sub-title2">유이자 할부로 진행</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 card-items">
                <div class="card-inst">
                    <div class="card-body-inst">
                        <h5 class="linear-text numbers"><b>03</b></h5>
                        <h5 class="card-title-inst sub-title3">5~48회차</h5>
                        <h5 class="sub-title3"><b>무이자 할부로 진행</b></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-div">
        <div class="waveform-data-container">
            <div class="row waveform-data-container-row">
                <div class="col">
                    <div class="card-waveform">
                        <h5><b>유이자 구간</b></h5>
                        <h6>신한카드 <b>7% 캐시백</b></h6>
                        <h6>결제 후 익월 15일 입금</h6>
                    </div>
                </div>
                <div class="col card-waveform2-col">
                    <div class="card-waveform-2">
                        <h5><b>무이자 구간</b></h5>
                    </div>
                </div>
            </div>
            <div class="">
                <img class="img d-md-block d-none" src="{{ themes('/images/waveform1.png') }}" alt="waveform">
                <img class="d-block d-md-none" src="{{ themes('/images/waveform-mobile.svg') }}" alt="waveform mobile">
            </div>
            {{--<div class="waveform-content-text"> --}}
               {{-- <div class="row">
                    <div class="col-1">
                        <h6>1회차<h6>
                    </div>
                    <div class="col-2">
                        <h6>2회차<h6>
                    </div>
                    <div class="col-3">
                        <h6>3회차</h6>
                    </div>
                    <div class="col-4">
                        <h6>4회차</h6>
                    </div>
                    <div class="col-5">
                        <h6>5회차</h6>
                    </div>
                    <div class="col-6">
                        <h6>48회차</h6>
                    </div>
                </div>
            </div>
            <div class="waveform-text-small">
                {{-- <h6>1회차 2회차 3회차 4회차 5회차 48회차</h6> --}}
            {{--</div> --}}
            <div class="col container-fluid">
                    <div class="card-waveform-3">
                        <h6>1~4회차 총 할부이자</h6>
                        <h6><b>평균 약 6% 부담</b></h6>
                    </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-12 mb-5 text-center">
                <a href="{{ route('48-pay.merchant.view') }}"><button id="submitBtn" type="button" class="btn btn-color submit-btn">가맹 상담 신청</button></a>
            </div>
        </div>
    </div>

@endsection
