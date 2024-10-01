@extends('bhub::sales.master',['title'=>'Branch Representative Registration'])

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('css/hanbada.css') }}">
    {!! htmlScriptTagJsApi() !!}
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="banner pt-4">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 text-center">
                    <p class="title1">한바다 통합 컨설팅 신청</p>
                </div>
                <div class="col-md-6 text-center mt-2">
                    <img class="banner_img1" src="{{ themes('/images/man.svg') }}">
                </div>
            </div>
        </div>
    </div>
    <section id="hanbada-consulting " class="pt-5">
        <div class="container">
            <div class="text-center">
                <h2 class="fw-bold title2"> 한바다 통합 컨설팅 이란? </h2>
                <img class="img-fluid mt-5" src="{{ themes('images/group.svg') }} " />
                <div class="card card-text-container mt-5 align-items-center">
                    <p class="text-center mb-0 w-50">
                        대표님들의 고민을 <span> 한 번에 해결 </span> 해 드립니다.<br />
                        <span> 경영, 세무, 노무, 자금, 투자, 보험 등 </span> 기업에 반드시 필요한 요소들을
                        각 분야별 최고의 전문가들이 대표님에게 꼭 필요한 것들을 컨설팅 합니다. <br />
                        이미 검증되고, <span> 최고의 만족도 </span>로 다시 찾는＂한바다 통합 컨설팅“ 지금 신청하세요.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div class="container container-lg mt-5">

        <div class="d-flex align-items-center justify-content-center" id="hanbada-container">
            <form class="align-items-center hanbada-form" action="{{ route('sales.hanbada.send') }}" method="POST">
                @csrf
                {{-- <h4 class="fw-bold text-center title2"> 통합 컨설팅 이란?</h4> --}}
                <div class="row">
                    <h4 class="fw-bold mb-0">기본정보</h4>
                    <div class=" col-md-12 col-sm-12 mt-3">
                        <div class="form-group ">
                            <label class="mb-2" for="business_name_field">사업자명<b>*</b></label>
                            <input type="text" id="business_name_field" name="business_name" class="form-control"
                                placeholder="" required>
                            @error('business_name_field')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12">
                        <div class="form-group ">
                            <label class="mb-2" for="business_number_field">사업자 번호<b>*</b></label>
                            <input type="text" id="business_number_field" name="business_number" class="form-control"
                                placeholder="숫자만 입력해 주세요" required>
                            @error('business_number_field')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <label class="mb-2" for="representative_name_field">고객명<b>*</b></label>
                            <input type="text" id="representative_name_field" name="representative_name"
                                class="form-control" placeholder="" required>
                            @error('representative_name_field')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <label class="mb-2" for="contact_field">연락처<b>*</b></label>
                            <input type="text" id="contact_field" name="contact" class="form-control"
                                placeholder="숫자만 입력해 주세요" required>
                            @error('contact_field')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12" id="date_pic">
                        @include('bhub::sales.partials._date-time-picker', [
                            'min_time' => '09:00',
                            'max_time' => '18:00',
                            'interval' => 3,
                            'label' => '미팅 일자',
                        ])
                    </div>

                    <div class=" col-md-12 col-sm-12 ">
                        <div class="form-group  mb-0 ">
                            <label class="mb-2" for="meeting_location_field">미팅 장소<b>*</b></label>
                            <input type="text" id="meeting_location_field" name="meeting_location" class="form-control"
                                placeholder="" required>
                        </div>
                    </div>
                    <h4 class="fw-bold pt-5 mb-3"> 서비스 신청 항목 </h4>

                    <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="mb-2" for="application_field">벤처투자 소득 공제 및 절세 프로그램 <span>㈜메가인포
                                    제공</span></label>
                            <div class="input-with-checkbox">
                                <label>신청</label>
                                <input type="checkbox" id="application_checkbox" name="venture_investment"
                                    class="form-check-input">
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <label class="mb-2" for="full_name_field">기업 보험분석 및 절세 프로그램 <span>GA 보험사
                                    제공</span></label>
                            <div class="input-with-checkbox">
                                <label>신청</label>
                                <input type="checkbox" id="application_checkbox" name="coperate_insurance"
                                    class="form-check-input">
                            </div>
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <label class="mb-2" for="full_name_field">세무 전문 컨설팅 : 경정청구, 기장, 이익잉여금,  가지급금,
                                사내복지기금, 증여,상속 등 <span>세무법인 제공</span></label>
                            <div class="input-with-checkbox">
                                <label>신청</label>
                                <input type="checkbox" id="application_checkbox" name="professional_tax"
                                    class="form-check-input">
                            </div>
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <label class="mb-2" for="full_name_field">경영 전문 컨설팅 : 벤처인증, 이노비즈, 메인비즈, 연구소 설립, 특허,
                                병역 특례 등<span>㈜메가인포 제공</span></label>
                            <div class="input-with-checkbox">
                                <label>신청</label>
                                <input type="checkbox" id="application_checkbox" name="professional_mgt"
                                    class="form-check-input">
                            </div>
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <label class="mb-2" for="full_name_field">노무 컨설팅 : 청년 일자리 도약 장려금, 고용안정/창출 장려금,
                                장애인/고령자 고용 장려금 및 고용 지원금 등<span>노무법인 제공</span></label>
                            <div class="input-with-checkbox">
                                <label>신청</label>
                                <input type="checkbox" id="application_checkbox" name="labor_consulting"
                                    class="form-check-input">
                            </div>
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <label class="mb-2" for="full_name_field">정부 정책 자금 컨설팅 (중,소 상공인 지원) <span>정책자금 운용사
                                    제공</span></label>
                            <div class="input-with-checkbox">
                                <label>신청</label>
                                <input type="checkbox" id="application_checkbox" name="govt_policy"
                                    class="form-check-input">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 mt-4" style="display: flex">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terms_and_service1"
                                id="term_service1">
                        </div>
                        <label class="form-check-label consent-label">
                            <p>[필수] 위 개인정보 수집, 이용에 동의합니다. <span class="colored agreement1" style="cursor: pointer;"> [내용보기] </span></p>
                        </label>
                    </div>

                    <div class="col-md-12 col-sm-12" style="display: flex">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terms_and_service2"
                                id="term_service2">
                        </div>
                        <label class="form-check-label consent-label">
                            <p>[필수] 위 개인정보 제3자 제공에 동의합니다. <span class="colored agreement2" style="cursor: pointer;"> [내용보기] </span></p>
                        </label>
                    </div>

                    {{-- <div class="form-group mt-3">
                         {!! htmlFormSnippet() !!}
                    </div> --}}
                    <div class="form-group mt-3">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                    </div>
                    @error('g-recaptcha-response')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="hidden" id="reCaptchaValue" value="failed">

                    @include('bhub::sales.partials._bhid-hidden-input')

                    <div class="col-md-12 col-sm-12 col-lg-12 mt-5 text-center">
                        <button id="submitBtn" type="submit" class="btn btn-color submit-btn bhub-submit-btn" disabled>상담 신청</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        const formInputs = document.querySelectorAll('.hanbada-form input, .hanbada-form textarea');
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
            const term1 = document.getElementById('term_service1');
            const term2 = document.getElementById('term_service2');

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
            $('.hanbada-form').on('change', 'input[type="checkbox"]', function() {
                validateForm();
            });

            $('.hanbada-form').on('change', 'select', function() {
                validateForm();
            });

            var data1 = "";
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> 1. 수집하는 개인정보 항목: 성명 / 전화번호 / 사업장명, 사업자 번호 (선택적) / 주소(선택적)</p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">2. 개인정보의 수집 목적</p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 상품 또는 서비스 문의 요청에 대한 답변 </p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 상품 또는 서비스에 대한 주문 처리 및 배송 정보 제공 </p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 3) 상품 또는 서비스 이용에 관한 통계, 분석, 개인화 서비스 제공 </p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 4) 상품 또는 서비스 구매 이후, 고객 상담 및 클레임 처리 / 부정행위 방지 </p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">3. 개인정보의 보유 및 이용 기간 </p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 일반 상담 및 문의 : 최종 상담 이후 1년간 보관 후 파기</p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 전자상거래법에 의해 5년간 보관 후 파기</p></b> \n'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">4. 본 동의를 거부할 권리가 있으며, 동의 거부 시 상담, 상품 구매나 서비스 이용에 제한이 있을 수 있습니다. </p></b> \n'
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