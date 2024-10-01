@extends('layouts.master')

@section('title', '결제 구조 | Business Hub')

@section('css')
    <link rel="stylesheet" href="{{ themes('css/payment.css') }}">
@stop

@section('content')
    <div class="upper-money-cards mt-md-4">
        <div class="middle-text-left">
            <h5><b>7% 고객 현금 캐시백</b> <br />
                (결제 후 익월 15일)</h5>
        </div>
        <div class="main-card-container">
            <div class="text-above-cards">
                <h2>결제 구조</h2>
            </div>
            <div class="picture-card">
                <img src="{{ themes('images/payment_structure.png') }}" alt="payment_structure" />
            </div>
        </div>
        <div class="right-text">
            <h5>가맹점 정산 대금 지급<br />
                (결제 후 5~7일)</h5>
        </div>
    </div>
    <div class="below-card-content">
        <ul>
            <li>소비자 : 기존 신한카드 보유시, 별도 발급 필요 없음, 미보유시 신규 발급 (신용카드 종류 제한 없음)</li>
            <li>PG사는 판매 수수료 제외하고 가맹점에 대금 지급</li>
        </ul>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-12 mb-5 text-center">
        <a href="{{ route('48-pay.merchant.view') }}"><button id="submitBtn" type="button" class="btn btn-color submit-btn">가맹 상담 신청</button></a>
    </div>
@endsection
