@extends('bhub::sales.master',['title'=>'상담신청'])

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_responsive.css') }}" />
    {!! htmlScriptTagJsApi() !!}
    <style>
        .alert-success {
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #d4edda;
            /* Green background color */
            color: #155724;
            /* Green text color */
            border-color: #c3e6cb;
            padding: 10px;
            width: 300px;
            text-align: center;
            z-index: 9999;
        }

        .alert-danger {
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f8d7da;
            /* Red background color */
            color: #721c24;
            /* Red text color */
            border-color: #f5c6cb;
            padding: 10px;
            width: 300px;
            text-align: center;
            z-index: 9999;
        }
    </style>
@endsection

@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="banner mt-4">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <p class="title_interior">인테리어</p>
                </div>
                <div class="col-md-6 text-end text-md-end mt-4 mt-md-0">
                    <img class="banner_img1" src="{{ themes('/images/img17.png') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="pagetitle">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <p class="title2 mb-4">사업자 초기 비용 부담은 줄이고, 품질은 높이는 “인테리어”</p>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-6 sr_ul">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <img class="interior_details_img mb-4" src="{{ themes('/images/icon1.png') }}">
                            <p class="interior_details">인테리어 비용 <br />50%만 결제</p>
                        </div>
                        <div class="col-12 col-md-3 mt-5 mt-md-0">
                            <img class="interior_details_img mb-4" src="{{ themes('/images/icon2.png') }}">
                            <p class="interior_details">나머지는 12개월<br />무이자 할부</p>
                        </div>
                        <div class="col-12 col-md-3 mt-5 mt-md-0">
                            <img class="interior_details_img mb-4" src="{{ themes('/images/icon3.png') }}">
                            <p class="interior_details">축적된 인테리어<br />시공 경험</p>
                        </div>
                        <div class="col-12 col-md-3 mt-5 mt-md-0">
                            <img class="interior_details_img mb-4" src="{{ themes('/images/icon4.png') }}">
                            <p class="interior_details">자체 기술,인력<br />가격 경쟁력 보유</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-6 sr_ul">
                    <ul>
                        <li class="knee_stem_cell_details">주요 대상 : 개인, 법인 사업자 / 프랜차이즈 등</li>
                        <li class="knee_stem_cell_details">주요 인테리어 사례
                            <ul class="rd">
                                <li>- OO병원 인테리어 (서울,파주,시흥,광주,대전,양평 등)</li>
                                <li>- 프랜차이즈 : OO 삼계탕, OO 스터디 카페, OO 갈비 등</li>
                                <li>- 뷔페, 웨딩홀 : OO 뷔페, OO 웨딩홀, OO 파크 등</li>
                            </ul>
                        </li>
                        <li class="knee_stem_cell_details">업무 절차 : 문의 > 현장 실사 및 상담 > 결제 비율결정 > 견적 / 계약 > 공증 > 공사 진행</li>
                    </ul>
                </div>
                <div class="col-12 col-md-3"></div>
            </div>
        </div>
    </div>

    <div class="knee_stem_cell_form mb-5 pb-5">
        <div class="container">
            <div class="safety_cvr_form">
                <div class="row text-center">
                    <div class="col-12">
                        <p class="title2 mb-5">상담신청</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3"></div>
                    <div class="col-12 col-md-6">
                        <form id="knee_stem_cell_form" action="{{ route('sales.interior.send') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>성명<span>*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>연락처<span>*</span></label>
                                <input type="number" class="form-control" placeholder="숫자만 입력해 주세요" id="contact"
                                    name="contact" value="{{ old('contact') }}" required>
                                @error('contact')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>사업장 or 기관명<span>*</span></label>
                                <input type="text" class="form-control" id="organisation" name="organisation"
                                    value="{{ old('organisation') }}" required>
                                @error('organisation')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            @include('bhub::sales.partials._date-time-picker', [
                                'min_time' => '09:00',
                                'max_time' => '18:00',
                                'interval' => 3,
                                'label' => '통화 가능 일시',
                            ])
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="condition1" name="condition1"
                                    {{ old('condition1') ? 'checked' : '' }}>
                                <label class="form-check-label">
                                    [필수] 위 개인정보 수집, 이용에 동의합니다. <span class="agreement1" style="cursor: pointer;"> [내용보기] </span>
                                </label>
                            </div>
                            @error('condition1')
                                <div class="text-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  id="condition2" name="condition2"
                                {{ old('condition2') ? 'checked' : '' }}
                                >
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
                                <div class="text-danger mb-1">{{ $message }}</div>
                            @enderror
                            <input type="hidden" id="reCaptchaValue" value="failed">
                            @error('condition2')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror

                            @include('bhub::sales.partials._bhid-hidden-input')

                            <div class="text-center mt-5">
                                <button type="submit" class="btn knee_stem_cell_btn bhub-submit-btn" id="submitBtn"
                                    disabled>신청하기</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script>
        const term1 = document.getElementById('condition1');
        const term2 = document.getElementById('condition2');
        const formInputs = document.querySelectorAll(
                '.knee_stem_cell_form input[type="text"], .knee_stem_cell_form input[type="number"]');
        
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

            $('.knee_stem_cell_form').on('change', 'input[type="checkbox"]', function() {
                validateForm();
            });

            $('.knee_stem_cell_form').on('change', 'select', function() {
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