@extends('bhub::sales.master',['title'=>'안전 덮개 (스틸 그레이팅)'])
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        {!! htmlScriptTagJsApi() !!}
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="safety_cvr_banner">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <p class="title1">안전 덮개 (스틸 그레이팅)</p>
                </div>
                <div class="col-md-6 text-center text-md-center">
                    <img class="banner_img1" src="{{ themes('/images/img6.png') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="pagetitle">
        <div class="container">
            <div id="title_bg" class="display_desktop d-none d-md-block">
                <h2 class="title2">학교, 공공기관 등 안전사고 예방, 배수로 막힘 감소 효과</h2>
            </div>
            <div id="title_bg" class="display_mobile d-block d-md-none">
                <h2 class="title2 mb-2">학교, 공공기관 등 안전사고 예방,</h2>
            </div>
            <div id="title_bg" class="display_mobile d-block d-md-none">
                <h2 class="title2" id="responsive_title2">배수로 막힘 감소 효과</h2>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <p class="title2 mb-4">스틸 그레이팅 안전 덮개?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-6 sr_ul">
                    <ul>
                        <li class="knee_stem_cell_details">학교 / 거리 / 운동장 / 건물 등에 설치되어 있는 스틸 그레이팅 위에 설치</li>
                        <li class="knee_stem_cell_details">안전사고 방지 효과</li>
                        <li class="knee_stem_cell_details">장애인 이동권 확대 효과</li>
                        <li class="knee_stem_cell_details">하수 관리 효과</li>
                        <li class="knee_stem_cell_details">도시환경 개선 효과</li>
                        <li class="knee_stem_cell_details">악취 및 해충 차단 효과</li>
                    </ul>
                </div>
                <div class="col-12 col-md-3"></div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-7 sr_ul">
                    <p class="knee_stem_cell_details"><i class="fa fa-check" aria-hidden="true"></i>&nbsp 주요 계약 사례</p>
                    <ul>
                        <li class="knee_stem_cell_details">학교 / 관공서 / 공기업 등</li>
                    </ul>
                    <p class="mt-5 knee_stem_cell_details">“1호 나라장터 등록, 이미 오랜 기간, 수많은 시공으로 검증된 우수 기업, 우수 제품입니다.”</p>
                </div>
                <div class="col-12 col-md-2"></div>
            </div>
        </div>
    </div>
    <div class="gallery mt-5 pt-0 pt-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <img class="mt-4" src="{{ themes('/images/img7.png') }}">
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <div class="row">
                        <div class="col-md-6 d-none d-md-block">
                            <img class="mt-4" src="{{ themes('/images/img8.png') }}">
                            <img class="mt-4" src="{{ themes('/images/img9.png') }}">
                        </div>
                        <div class="col-md-6 d-none d-md-block">
                            <img class="mt-4" src="{{ themes('/images/img10.png') }}">
                            <img class="mt-4" src="{{ themes('/images/img11.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10 d-block d-md-none">
                    <img class="mt-4" src="{{ themes('/images/img12.png') }}">
                    <img class="mt-4" src="{{ themes('/images/img13.png') }}">
                    <img class="mt-4" src="{{ themes('/images/img14.png') }}">
                    <img class="mt-4" src="{{ themes('/images/img15.png') }}">
                    <img class="mt-4" src="{{ themes('/images/img16.png') }}">
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
    <div class="knee_stem_cell_form mb-5 pb-5">
        <div class="container">
            <div class="safety_cvr_form">
                <div class="row text-center">
                    <div class="col-12">
                        <p class="title2 mb-5">상담 신청</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3"></div>
                    <div class="col-12 col-md-6">
                        <form id="knee_stem_cell_form" class="safety_cover_form"
                            action="{{ route('sales.safety-cover.send') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>성명<span>*</span></label>
                                <input type="text" class="form-control" id="" name="user_name" required>
                                @error('user_name')
                                    <div class="text-danger">{{ $user_name }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>연락처<span>*</span></label>
                                <input type="text" class="form-control" placeholder="숫자만 입력해 주세요" id=""
                                    name="contact" required>
                                @error('contact')
                                    <div class="text-danger">{{ $contact }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>사업자명 or 기관명<span>*</span></label>
                                <input type="text" class="form-control" id="" name="business_name" required>
                                @error('business_name')
                                    <div class="text-danger">{{ $business_name }}</div>
                                @enderror
                            </div>
                            @include('bhub::sales.partials._date-time-picker', [
                                'min_time' => '09:00',
                                'max_time' => '18:00',
                                'interval' => 3,
                                'label' => '통화 가능 일시',
                            ])
                            <div class="form-check mt-4 condition1">
                                <input class="form-check-input" type="checkbox" id="term_service1" name="terms_and_service1">
                                <label class="form-check-label">
                                    [필수] 위 개인정보 수집, 이용에 동의합니다. <span class="agreement1" style="cursor: pointer;"> [내용보기] </span>
                                </label>
                            </div>
                            <div class="form-check mb-5">
                                <input class="form-check-input" type="checkbox" id="term_service2" name="terms_and_service2">
                                <label class="form-check-label">
                                    [필수] 위 개인정보 제3자 제공에 동의합니다. <span class="agreement2" style="cursor: pointer;"> [내용보기] </span>
                                </label>
                            </div>
                            {{-- <div class="form-group mt-3 mb-4">
                                 {!! htmlFormSnippet() !!}
                            </div> --}}
                            <div class="form-group mt-3 mb-4">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                            </div>
                            @error('g-recaptcha-response')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="hidden" id="reCaptchaValue" value="failed">
                            @include('bhub::sales.partials._bhid-hidden-input')

                            <div class="text-center">
                                <button type="submit" id="submitBtn" class="btn knee_stem_cell_btn bhub-submit-btn"
                                    disabled>신청하기</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
    @php
        $currentTime = strtotime('+3 hours');
    @endphp
@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script>
        const term1 = document.getElementById('term_service1');
        const term2 = document.getElementById('term_service2');
        const formInputs = document.querySelectorAll(
                '.safety_cover_form input, .safety_cover_form textarea');
        var reCaptchaInput = document.getElementById('reCaptchaValue');
        function onRecaptchaSuccess(token){
            reCaptchaInput.setAttribute('value', 'success');
            validateForm();
        }

        function onRecaptchaExpired(){
            reCaptchaInput.setAttribute('value', 'failed');
            validateForm();
        }

        function validateForm() {
            let isFormValid = true;
            formInputs.forEach(function(input) {
                if (input.required && input.value.trim() === '') {
                    isFormValid = false;
                }
            });
            const submitBtn = document.getElementById('submitBtn');
            if (yearSelect.value === '' || monthSelect.value === '' || daySelect.value === '' || hourSelect
                .value === '' ||
                hourSelect.value == '시간선택' || term1.checked === false || term2.checked === false) {
                isFormValid = false;
            }

            var reCaptchaInput = document.getElementById('reCaptchaValue')
            if(reCaptchaInput.getAttribute('value') == 'failed'){
                isFormValid = false;
            }

            if (isFormValid) {
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.setAttribute('disabled', 'disabled');
            }
        }
        $(document).ready(function() {
            formInputs.forEach(function(input) {
                input.addEventListener('input', validateForm);
            });
            $('.safety_cover_form').on('change', 'input[type="checkbox"]', function() {
                validateForm();
            });
            $('.safety_cover_form').on('change', 'select', function() {
                validateForm();
            });

            var data1 = "";
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> 1. 수집하는 개인정보 항목: 성명 / 전화번호 / 사업장명, 사업자 번호 (선택적) / 주소(선택적)</p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">2. 개인정보의 수집 목적</p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 상품 또는 서비스 문의 요청에 대한 답변 </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 상품 또는 서비스에 대한 주문 처리 및 배송 정보 제공 </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 3) 상품 또는 서비스 이용에 관한 통계, 분석, 개인화 서비스 제공 </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 4) 상품 또는 서비스 구매 이후, 고객 상담 및 클레임 처리 / 부정행위 방지 </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">3. 개인정보의 보유 및 이용 기간 </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 일반 상담 및 문의 : 최종 상담 이후 1년간 보관 후 파기</p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 전자상거래법에 의해 5년간 보관 후 파기</p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">4. 본 동의를 거부할 권리가 있으며, 동의 거부 시 상담, 상품 구매나 서비스 이용에 제한이 있을 수 있습니다. </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">5. 동의철회 및 개인정보 열람/정정/삭제 요청 방법: 본사 {{ setting('bh_telephone', '') }} 전화, 본인 확인 후 처리 </p></b>'


            document.querySelector('.agreement1').onclick = function () {
            swal({
                title: "[필수] 개인정보 수집 및 이용 동의",
                html: data1,
                confirmButtonText: 'Ok',
                closeOnConfirm: false,
                closeOnCancel: false
            },
             function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted!", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
            };

            var data2 = "";
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> 1. 개인정보를 제공받는 자: ㈜비즈니스허브 / 해당 상품 및 서비스 제휴사 </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;">2. 제공받는 자의 이용 목적 </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 상품 또는 서비스 문의 요청에 대한 답변 </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 상품 또는 서비스에 대한 주문 처리 및 배송 정보 제공 </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 3) 상품 또는 서비스 이용에 관한 통계, 분석, 개인화 서비스 제공  </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 4) 상품 또는 서비스 구매 이후, 고객 상담 및 클레임 처리 / 부정행위 방지 </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;">3. 개인정보의 보유 및 이용 기간 </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 일반 상담 및 문의 : 최종 상담 이후 1년간 보관 후 파기</p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 전자상거래법에 의해 5년간 보관 후 파기</p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;">4. 본 동의를 거부할 권리가 있으며, 동의 거부 시 상담, 상품 구매나 서비스 이용에 제한이 있을 수 있습니다. </p></b> <br>'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;">5. 동의철회 및 개인정보 열람/정정/삭제 요청 방법: 본사 {{ setting('bh_telephone', '') }} 전화, 본인 확인 후 처리 </p></b>'

            document.querySelector('.agreement2').onclick = function () {
            swal({
                title: "[필수] 개인정보 제3자 제공 동의",
                html: data1,
                confirmButtonText: 'Ok',
                closeOnConfirm: false,
                closeOnCancel: false
            },
             function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted!", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
            };
        });
    </script>
@endsection