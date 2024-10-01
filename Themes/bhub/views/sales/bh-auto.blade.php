@extends('bhub::sales.master',['title'=>'BH Auto'])

@section('css')
    <link rel="stylesheet" href="{{ themes('css/bh-auto.css') }}">
@endsection


@section('content')
    @include('bhub::sales.partials._nav')

    <section id="hero" class="d-flex d-sm-flex">
        <div class="container  d-md-block">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6">
                    <h2 class="text-lg-center text-sm-start detail-title-page">BH Auto</h2>
                </div>
                <div class="col-lg-6 hero-img  align-items-center">
                    <div class="hero-img-inner">
                        <img src="{{ themes('/images/banner-image.svg') }}" class="img-fluid d-none d-xl-block" alt="banner-img">
                        <img src="{{ themes('/images/mobile_car.svg') }}" class="img-fluid d-lg-none d-sm-flex" alt="banner-img">
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="empty_section"></section>

    <section id="middle-section">
        <div class="container px-150">

        <div class="d-flex flex-column flex-lg-row flex-md-row d-sm-flex justify-content-between align-items-center  image-box-wrapper">
            <div>
                <div class="car-details">
                    <div class="car-details-text">리스, 렌탈 출고 시</div>
                </div>
                <div class="car-details-mobile text-nowrap"><h4>리스, 렌탈 출고 시</h4></div>

                <div class="d-flex align-items-center image-box-wrapper flex-column flex-lg-row flex-md-row">
                    <div class="image-box d-flex align-items-cnter justify-content-between flex-column">
                        <div class="image-container text-center rounded-circle bg-light ">
                            <img src="{{ themes('/images/person.svg') }}" alt="" />
                        </div>
                        <div class="inner-content text-center pt-4">
                            <h5 class="title">대상</h5>
                            <p class="text">개인 / 사업자<br>(법인,개인)</p>
                        </div>
                    </div>
                    <div class="image-box d-flex align-items-cnter justify-content-center flex-column">
                        <div class="image-container text-center rounded-circle bg-light ">
                            <img src="{{ themes('/images/car.svg') }}" alt="" />
                        </div>
                        <div class="inner-content text-center pt-4">
                            <h5 class="title">차종</h5>
                            <p class="text">국산차<br>수입차</p>
                        </div>
                    </div>
                    <div class="image-box d-flex align-items-cnter justify-content-center flex-column">
                        <div class="image-container text-center rounded-circle bg-light ">
                            <img src="{{ themes('/images/calendar_month.svg') }}" alt="" />
                        </div>
                        <div class="inner-content text-center pt-4">
                            <h5 class="title">납부시기</h5>
                            <p class="text">매월 후취</p>
                        </div>
                    </div>
                    <div class="image-box d-flex align-items-cnter justify-content-center flex-column">
                        <div class="image-container text-center rounded-circle bg-light ">
                            <img src="{{ themes('/images/check.svg') }}" alt="" />
                        </div>
                        <div class="inner-content text-center pt-4">
                            <h5 class="title">만기 후 처리</h5>
                            <p class="text">반납,구매,연장<br>선택 가능</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="car-details">
                        <div class="car-details-second-text">영업 수수료</div>
                    </div>
                    <div class="car-details-second-text-mobile text-nowrap"><h4> 영업 수수료</h4></div>

                    <div class="d-flex align-items-center">
                        <div class="image-box d-flex align-items-cnter justify-content-center flex-column">
                            <div class="image-container text-center rounded-circle bg-light ">
                                <img src="{{ themes('/images/group_dir.svg') }}" alt="" />
                            </div>
                            <div class="inner-content text-center pt-4">
                                <h5 class="title ">금액 / 시기</h5>
                                <p class="text">차량가액 기준<br>익월 일괄 지급</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="empty_section"></section>

    <section>
        <div class="container px-150">
            <div class="d-flex justify-content-between align-items-center image-box-wrapper-second  flex-column flex-lg-row flex-md-row">
                <div class="image-box d-flex align-items-center justify-content-center flex-column">
                    <div class="image-container-second text-center rounded-circle bg-light ">
                        <img src="{{ themes('/images/group_car.svg') }}" alt="" />
                    </div>
                    <div class="inner-content text-center pt-4">
                        <h5 class="title ">세금보험료 걱정 NO!</h5>
                        <p class="text">계약기간동안 자동차세와<br>각종 보험료를 절약해보세요</p>
                    </div>
                </div>
                <div class="image-box d-flex align-items-cnter justify-content-center flex-column">
                    <div class="image-container-second text-center rounded-circle bg-light ">
                        <img src="{{ themes('/images/group_bar.svg') }}" alt="" />
                    </div>
                    <div class="inner-content text-center pt-4">
                        <h5 class="title ">맞춤요금제 선택!</h5>
                        <p class="text">나에게 맞는 상품을 설정하여<br>월납입부담을 줄여보세요</p>
                    </div>
                </div>
                <div class="image-box d-flex align-items-cnter justify-content-center flex-column">
                    <div class="image-container-second text-center rounded-circle bg-light ">
                        <img src="{{ themes('/images/group_notes.svg') }}"  alt="" />
                    </div>
                    <div class="inner-content text-center pt-4">
                        <h5 class="title ">초기비용 ZERO!</h5>
                        <p class="text">초기비용 걱정없이 다이렉트 렌트카로<br>저렴하게 이용해보세요</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="empty_section"></section>

    <section>
        <div class="container d-flex justify-content-center">
            <div class="info">
                <div class="title text-center">
                    <h4>주요 차종</h4>
                </div>
                <ul>
                    <li>국산차: 현대,기아,GM대우,삼성르노, KG모빌리티</li>
                    <li>수입차: 벤츠, BMW, 아우디, 랜드로버, 렉서스, 볼보, 폭스바겐, 포르쉐</li>
                    <li> 구입 형태 : 리스/렌트/할부/현금 모두 고객의 니즈에 맞추어 구입 가능함</li>
                    <li>영업수수료 : 최종 차량가액 기준으로 비즈플래너에게 익월 수수료 지급</li>
                    <li>고객의 구입 차종, 구입형태, 신용 등에 따라 수수료 차이가 있음</li>
                </ul>

            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-lg-12 mb-5 mt-5 text-center">
            <button type="button" onclick="window.location.href = '{{ route('sales.bh-auto-contact-us') }}'" class="btn btn-color submit-btn">신청하기</button>
        </div>
    </section>

    <section class="empty_section"></section>

@endsection

@section('js')
@endsection
