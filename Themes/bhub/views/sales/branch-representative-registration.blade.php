@extends('bhub::sales.master',['title'=>'지사대표등록'])
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_responsive.css') }}" />
    <style>
    .headding .box {
            height: 280px;
    }
    .info {
        width: 75%;
        margin: 0 auto;
    }
    .text_data:hover {
        color: #373737;
    }
    @media(max-width: 767px){
        .info {
            width: 80%;
        }
        .headding .box {
            height: 252px;
        }
    }
    </style>

@endsection

@section('content')
    @include('bhub::sales.partials._nav')
    <div class="banner mt-4">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <p class="title1">새로운 비즈니스의 시작</p>
                    <p class="title2">지사대표 등록</p>
                </div>
                <div class="col-md-6 text-end">
                    <img class="banner_img1" src="{{ themes('/images/banner_img1.png') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="headding">
        <div class="container">
            <h2 class="mt-5 mb-5">지사대표, Why?</h2>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="box">
                        <img src="{{ themes('/images/img1.png') }}">
                        <div class="a_center">
                            <p class="line"></p>
                        </div>
                        <p class="info">아이템을 직접 찾을 필요가 없으니까!</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box">
                        <img src="{{ themes('/images/img2.png') }}">
                        <div class="a_center">
                            <p class="line"></p>
                        </div>
                        <p class="info">좋은 영업 아이템들만 한 곳에 모았으니까!</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box">
                        <img src="{{ themes('/images/img3.png') }}">
                        <div class="a_center">
                            <p class="line"></p>
                        </div>
                        <p class="info">스마트폰으로 비즈니스가 가능하니까!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="box">
                        <img src="{{ themes('/images/img4.png') }}">
                        <p class="line"></p>
                        <p class="info">나에게 맞는 영업 아이템을 골라서 할 수 있으니까!</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box">
                        <img src="{{ themes('/images/img5.png') }}">
                        <p class="line"></p>
                        <p class="info">체계적인 비즈니스를 할 수 있으니까!</p>
                    </div>
                </div>
                <div class="col-4">

                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5 mb-5">
        <a href="{{route('branch-representative')}}"  class="text_data" >*지사대표에 대해 좀 더 알고 싶다면?</a>

        <br/>

        @if(request()->has('bhid'))
           <a href="{{route('registration').'?bhid='. request()->get('bhid')}}" type="button" class="btn btn_submit mt-5">등록하기</a>
        @else
            <a href="{{route('registration')}}" type="button" class="btn btn_submit mt-5">등록하기</a>
        @endif
    </div>
@endsection
@section('js')
@endsection
