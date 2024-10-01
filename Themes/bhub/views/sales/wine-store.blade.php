@extends('bhub::sales.master',['title'=>'최저가 와인 판매 전문점 창업'])
@section('css')
    <link rel="stylesheet" href="{{ themes('css/wine-store.css') }}">
    {!! htmlScriptTagJsApi() !!}
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="store_banner_main  d-flex justify-content-center align-items-center">
        <h3 class="title1">최저가 와인 판매 전문점 창업</h3>
    </div>
    <section class="pt-5">
        <div class="container">
            <div class="info mt-5 mx-auto text-center">
                <h2 class="fw-bold title2 "> 와인과 커피를 한 곳에서 </h2>
                <p class=" mb-0 ">
                    수입사와 가맹점 직거래를 통한 최저가 와인 할인 매장
                </p>
            </div>
        </div>
    </section>
    <section class="pt-5 ">
        <div class="container">
            <div class="mt-md-5 info_solution  mx-auto">
                <h4 class="fw-bold title2 mb-5 text-center">가맹점 모집</h4>
                <ul class="">
                    <li>총 창업비용 : 6,000~8,000만원 (전용면적 15평 미만 기준)</li>
                    <li>실제 1원도 추가 없는 실제 창업비용 양심 안내</span></li>
                    <li>최저가는 기본입니다. 최저가 와인 할인매장</li>
                    <li>최저판매가 기준 평균 마진율 : 45%~50%</li>
                    <li>온라인 플랫폼 지원으로 추가적인 매출 창출</li>
                    <li>가맹점주가 만족해서 먼저 찾습니다. (본사 슈퍼바이징 서비스)</li>

                </ul>
            </div>
        </div>
        <div class="container pt-5">
            <div class="row thumb_images_row">
                <div class="col-md-6 thumb-images">
                    <img src="{{ themes('images/wine_tabs_1.svg') }}" class="w-100" />
                </div>
                <div class="col-md-6 thumb-images">
                    <img src="{{ themes('images/wine_tabs_2.svg') }}" class="w-100" />
                </div>
            </div>
        </div>
    </section>
    <section class="pt-md-5">
        <div class="container container-lg form-container mb-5">
            <div class="d-flex align-items-center justify-content-center ">
                <form class="align-items-center rental-form" action="{{ route('sales.wine-store.send') }}" method="POST">
                    @csrf
                    <h4 class="fw-bold text-center title2"> 상담 신청</h4>
                    <div class="row">
                        <div class=" col-md-12 col-sm-12 mt-3">
                            <div class="form-group ">
                                <div class="position-relative">
                                    <label class="mb-2" for="">성명</label><span class="colored dot">.</span>
                                </div>

                                <input type="text" name="name" class="form-control" placeholder=""
                                    value="{{ old('name') }}" required>

                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class=" col-md-12 col-sm-12">
                            <div class="form-group ">
                                <div class="position-relative">
                                    <label class="mb-2" for="business_number_field">연락처</label><span
                                        class="colored dot">.</span>
                                </div>
                                <input type="number" id="business_number_field" name="business_number" class="form-control"
                                    placeholder="숫자만 입력해 주세요" value="{{ old('business_number') }}" required>

                                @error('business_number')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class=" col-md-12 col-sm-12  ">
                            @include('bhub::sales.partials._date-time-picker', [
                                'min_time' => '09:00',
                                'max_time' => '18:00',
                                'interval' => 3,
                                'label' => '통화 가능 일시',
                            ])
                        </div>

                        <div class="col-md-12 col-sm-12 mt-md-4" style="display: flex">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="terms_and_service1"
                                    id="check_box_field1" {{ old('terms_and_service1') ? 'checked' : '' }}>
                            </div>
                            <label class="form-check-label consent-label">
                                <p>[필수] 위 개인정보 수집, 이용에 동의합니다. <span class="colored agreement1" style="cursor: pointer;"> [내용보기] </span></p>
                            </label>
                        </div>
                        @error('terms_and_service1')
                            <div class="text-danger mb-1">{{ $message }}</div>
                        @enderror

                        <div class="col-md-12 col-sm-12" style="display: flex">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="terms_and_service2"
                                    id="check_box_field2" {{ old('terms_and_service2') ? 'checked' : '' }}>
                            </div>
                            <label class="form-check-label consent-label">
                                <p>[필수] 위 개인정보 제3자 제공에 동의합니다. <span class="colored agreement2" style="cursor: pointer;"> [내용보기] </span></p>
                            </label>
                        </div>
                        @error('terms_and_service2')
                            <div class="text-danger mb-1">{{ $message }}</div>
                        @enderror
                        {{-- <div class="form-group mt-3">
                             {!! htmlFormSnippet() !!}
                        </div> --}}
                        <div class="form-group mt-3">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                        </div>
                        @error('g-recaptcha-response')
                            <div class="text-danger mb-1">{{ $message }}</div>
                        @enderror
                        <input type="hidden" id="reCaptchaValue" value="failed">
                        @include('bhub::sales.partials._bhid-hidden-input')
                        <div class="col-md-12 col-sm-12 col-lg-12 mt-5 text-center">
                            <button id="submitBtn" type="submit" class="btn btn-color submit-btn bhub-submit-btn" disabled>신청하기</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        let isFormValid = true;
        const submitBtn = document.getElementById('submitBtn');
        const term1 = document.getElementById('check_box_field1');
        const term2 = document.getElementById('check_box_field2');
        var reCaptchaInput = document.getElementById('reCaptchaValue');
        const formInputs = document.querySelectorAll(
                '.rental-form input[type="text"]');

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
            const formCheck = document.querySelectorAll('.rental-form input[type="checkbox"]');

            formCheck.forEach(function(input) {
                input.addEventListener('change', validateForm);
            });
            $('.rental-form').on('change', 'select', function() {
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
