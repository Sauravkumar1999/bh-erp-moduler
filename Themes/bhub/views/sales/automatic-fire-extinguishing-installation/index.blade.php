@extends('bhub::sales.master',['title'=>' 자동 소화 장치, “키친 119” (법적 의무사항)'])

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ themes('css/automatic-fire-extinguishing-installation-style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ themes('css/automatic-fire-extinguishing-installation-responsive.css') }}" />
        {!! htmlScriptTagJsApi() !!}
    <style>
        .main .content .content-container .kitchen-form-container .form-content .form button.submit-btn:disabled {
            border: 1px solid #EC661A !important;
        }
    </style>

@endsection

@section('content')
    <div class="main">
        @include('bhub::sales.partials._session_alerts')
        @include('bhub::sales.partials._nav')

        <div class="banner">
            <div class="container-fluid banner-container">
                <h1>자동 소화 장치, “키친 119” <span class="d-block d-md-inline">(법적 의무사항)</span></h1>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid content-container">
                <div class="main-heading">
                    <h2> 상업용 주방 자동 소화 장치 설치가 의무화</h2>
                </div>
                <div class="sub-heading">
                    <h3>(소방시설법 시행일자 '23.12.01 이후 신설된 <span class="d-block d-md-inline">상업용 주방 시설)</span></h3>
                </div>

                <div class="image">
                    <img src="{{ themes('images/fire-extinguisher-install.png') }}" alt="fire-extinguisher-install" />
                </div>

                <div class="laws">
                    <div class="laws-container d-none d-md-block">
                        <h5>
                            소방청에 따르면 매년 연간 1000여건 이상의 음식점 급식실 화재로 인해 막대한 재산 피해나
                        </h5>
                        <h5>
                            인명 피해가 있어 국가에서는 재난을 방지하기 위해 <span>국민안전처 주관</span>으로 <span>2023년 상반기</span>
                        </h5>
                        <h5>
                            <span>12월부터는 건물 또는 상가</span>에 상업용 또는 급식용으로설치된 주방의 후드와 덕트, 가스
                        </h5>
                        <h5>
                            또는 전기사용의 조리기구에는 <span>법적 설치의무 대상으로 자동소화장치 설치가 의무화</span>가 되었습니다.
                        </h5>
                    </div>

                    <div class="laws-container d-block d-md-none">
                        <h5>소방청에 따르면 매년 연간 1000여건 이상의 음식점 급식실</h5>
                        <h5>화재로 인해 막대한 재산 피해나 인명 피해가 있어 국가에서는</h5>
                        <h5>재난을 방지하기 위해 <span>국민안전처 주관</span>으로 <span>2023년 상반기</span></h5>
                        <h5><span>12월부터는 건물 또는 상가</span>에 상업용 또는 급식용으로설치된</h5>
                        <h5>주방의 후드와 덕트, 가스 또는 전기사용의 조리기구에는 <span>법적</span></h5>
                        <h5><span>설치의무 대상으로 자동소화장치 설치가 의무화</span>가 되었습니다.</h5>
                    </div>
                </div>

                <div class="middle-heading">
                    <h2>상업용 주방 자동 소화 장치 <span>키친 119</span></h2>
                </div>

                <div class="kitchen-form-container">
                    <div class="kitchen-image">
                        <img src="{{ themes('images/kitchen-119.png') }}" alt="kitchen-119" />
                    </div>

                    <div class="form-content">
                        <div class="middle-heading1">
                            <h2>상담 신청</h2>
                        </div>
                        <form class="form automatic_fire_extinguisher_form" method="POST"
                            action="{{ route('sales.automatic-fire-extinguishing-installation.send') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="user_name">성명 <img src="{{ themes('images/required.svg') }}"
                                            alt=""></label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                                    @error('user_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="contact">연락처 <img src="{{ themes('images/required.svg') }}"
                                            alt=""></label>
                                    <input type="text" class="form-control" id="contact" name="contact"
                                        placeholder="숫자만 입력해 주세요" required>

                                    @error('contact')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="business_name">상호명 <img src="{{ themes('images/required.svg') }}"
                                            alt=""></label>
                                    <input type="text" class="form-control" id="business_name" name="business_name" required>

                                    @error('business_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                @include('bhub::sales.partials._date-time-picker', [
                                    'min_time' => '09:00',
                                    'max_time' => '18:00',
                                    'interval' => 3,
                                    'label'    => '통화 가능 일시'
                                ])

                                <div class="form-group col-md-12 form-check-container">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="term_service1"
                                            name="term_service1">
                                        <label class="form-check-label" for="term_service1">
                                            [필수] 위 개인정보 수집, 이용에 동의합니다. <span class="colored agreement1" style="cursor: pointer;"> [내용보기] </span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="term_service2">
                                        <label class="form-check-label" for="term_service2" name="term_service2">
                                           [필수] 위 개인정보 제3자 제공에 동의합니다. <span class="colored agreement2" style="cursor: pointer;"> [내용보기] </span>
                                        </label>
                                    </div>
                                </div>
                                {{-- <div class="form-group mt-4">
                                     {!! htmlFormSnippet() !!}
                               </div> --}}

                                <div class="form-group mt-3 mb-4">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                                </div>
                                @error('g-recaptcha-response')
                                    <div class="text-danger mb-1">{{ $message }}</div>
                                @enderror
                                <input type="hidden" id="reCaptchaValue" value="failed">
                            </div>
                            @include('bhub::sales.partials._bhid-hidden-input')
                            <div class="text-center">
                                <button type="submit" class="btn submit-btn bhub-submit-btn" id="submitBtn" style="border: none !important;" disabled>신청하기</button>
                            </div>
                        </form>

                        <div class="findout-btn-container">
                            <a href="{{ route('sales.automatic-fire-extinguishing-installation.more-info') }}"  class="btn findout-btn" >더 많은 정보 알아보기 +</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        let isFormValid = true;
        const submitBtn = document.getElementById('submitBtn');
        const term1 = document.getElementById('term_service1');
        const term2 = document.getElementById('term_service2');
        const formInputs = document.querySelectorAll(
                '.automatic_fire_extinguisher_form input[type="text"]');

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
            isFormValid = true;

            formInputs.forEach(function(input) {
                if (input.required && input.value.trim() === '') {
                    isFormValid = false;
                }
            });

            if (yearSelect.value === '' || monthSelect.value === '' || daySelect.value === '' || hourSelect.value === ''
                || hourSelect.value == '시간선택' || term1.checked === false || term2.checked === false) {
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
            const formCheck = document.querySelectorAll('.automatic_fire_extinguisher_form input[type="checkbox"]');

            formCheck.forEach(function(input) {
                input.addEventListener('change', validateForm);
            });
            $('.automatic_fire_extinguisher_form').on('change', 'select', function() {
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
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> 1. 개인정보를 제공받는 자: ㈜비즈니스허브 / 해당 상품 및 서비스 제휴사 </p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;">2. 제공받는 자의 이용 목적 </p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 상품 또는 서비스 문의 요청에 대한 답변 </p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 상품 또는 서비스에 대한 주문 처리 및 배송 정보 제공 </p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 3) 상품 또는 서비스 이용에 관한 통계, 분석, 개인화 서비스 제공  </p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 4) 상품 또는 서비스 구매 이후, 고객 상담 및 클레임 처리 / 부정행위 방지 </p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;">3. 개인정보의 보유 및 이용 기간 </p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 일반 상담 및 문의 : 최종 상담 이후 1년간 보관 후 파기</p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 전자상거래법에 의해 5년간 보관 후 파기</p></b> \n'
                data2 = data2 + '<b><p align="left" style="font-size: 14px;color:#000;">4. 본 동의를 거부할 권리가 있으며, 동의 거부 시 상담, 상품 구매나 서비스 이용에 제한이 있을 수 있습니다. </p></b> \n'
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