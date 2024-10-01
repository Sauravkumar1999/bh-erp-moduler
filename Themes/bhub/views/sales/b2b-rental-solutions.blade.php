@extends('bhub::sales.master',['title'=>'B2B 렌탈 솔루션'])
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('css/rental.css') }}">
    {!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
    @include('bhub::sales.partials._nav')
    <div class="rental_banner">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 col-12 ">
                    <p class="title1">B2B 렌탈 솔루션</p>
                </div>
                <div class="col-md-6 col-12  text-center mt-2">
                    <img class="banner_img1" src="{{ themes('/images/rental-banner.svg') }}">
                </div>
            </div>
        </div>
    </div>
    <section class="pt-5">
        <div class="container">
            <div class="info mt-5 mx-auto">
                <h2 class="fw-bold title2 text-center"> B2B 렌탈 솔루션? </h2>
                <p class=" mb-0 ">
                    B2B 렌탈 솔루션 이란, 개인 또는 법인 사업자의 소유 동산 자산을 렌탈사에 매각하여 사업자의 필요 자금을 조달하고,
                    <br>매각된 장비는 매월 렌탈료를 지급하여 지속 사용하는 서비스로 약정 만료 후에는 다시 동산 자산의 소유권은 사업자로 원복되는
                    <br>자금 조달과 비용 처리를 할 수 있는 신개념 솔루션 입니다.
                </p>
            </div>

        </div>
    </section>
    <section class="pt-5">
        <div class="container">
            <div class="info mt-5 info_solution  mx-auto">
                <h4 class="fw-bold title2 mb-5 text-center">B2B 렌탈 솔루션은 무엇이 좋은가요?</h4>
                <ul>
                    <li><span class="colored"> 모든 사업자(개인/법인) 신청 가능합니다.</span></li>
                    <li>대출 상품이 아니므로, 재무제표상 채무로 남지 않고 <span class="colored">신용 등급에도 영향이 없습니다.</span></li>
                    <li>개인 및 법인사업자는 높은 금액의 <span class="colored"> 필요 자금을 마련할 수 있습니다.</span> (신청 한도 : 최소 500만원~무제한)
                    </li>
                    <li>매월 납입하는 <span>렌탈료는 전액 비용 처리가 가능</span>하여 이미 많은 개인/법인 사업자들이 B2B 렌탈 솔루션을 선택하는 가장 큰 이유입니다.</li>
                    <li>주요 고객 : 병/의원, 한방병원, 제조업 관련 법인, 일반 법인 사업, 프랜차이즈 신규 개인사업자 등</li>
                </ul>
            </div>
        </div>
    </section>
    @include('bhub::sales.partials._session_alerts')
    <section class="mt-5">
        <div class="container">
            <div class="row thumb_images_row">
                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">병원</span>
                    <img src="{{ themes('images/rental_thumb.png') }}" class="w-100" />
                </div>
                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">관공서</span>
                    <img src="{{ themes('images/rental_thumb_2.png') }}" class="w-100" />
                </div>
                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">식당</span>
                    <img src="{{ themes('images/rental_thumb_3.png') }}" class="w-100" />
                </div>

                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">병원</span>
                    <img src="{{ themes('images/rental_thumb_4.png') }}" class="w-100" />
                </div>
                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">숙박업소</span>
                    <img src="{{ themes('images/rental_thumb_5.png') }}" class="w-100" />
                </div>
                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">아파트 오피스텔</span>
                    <img src="{{ themes('images/rental_thumb_6.png') }}" class="w-100" />
                </div>

                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">요식업</span>
                    <img src="{{ themes('images/rental_thumb_7.png') }}" class="w-100" />
                </div>
                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">프렌차이즈</span>
                    <img src="{{ themes('images/rental_thumb_8.png') }}" class="w-100" />
                </div>
                <div class="col-md-4 thumb-images">
                    <span class="thumb-images-text">신규사업자</span>
                    <img src="{{ themes('images/rental_thumb_9.png') }}" class="w-100" />
                </div>
            </div>

        </div>
    </section>
    <section id="" class="pt-5">
        <div class="container">
            <div class="info mt-5 w-75 mx-auto">
                <h2 class="fw-bold title2 mb-5 text-center"> 진행 절차 </h2>
                <div class="icon-grid">
                    <div class="text-center ">
                        <div class="bg-round">
                            <img src="{{ themes('images/computer.svg') }}" class="" />
                        </div>
                        <p class="mt-4 mx-auto w-50">문의 접수</p>
                    </div>
                    <div class= "dashed_bg">
                        <div class="dashed">
                        </div>
                    </div>
                    <div class="text-center ">
                        <div class="bg-round">
                            <img src="{{ themes('images/search.svg') }}" class="" />
                        </div>
                        <p class="mt-4 mx-auto w-50">현장 또는
                            온라인 상담</p>
                    </div>
                    <div class= "dashed_bg">
                        <div class="dashed">

                        </div>
                    </div>
                    <div class="text-center ">
                        <div class="bg-round">
                            <img src="{{ themes('images/notepad.svg') }}" class="" />
                        </div>
                        <p class="mt-4 mx-auto w-50">B2B 렌탈
                            계약 체결</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="container container-lg mt-5 mb-5">
        <div class="d-flex align-items-center justify-content-center ">
            <form class="align-items-center rental-form" id="rental-form" action="#" method="POST">
                @csrf
                <h4 class="fw-bold text-center title2"> 상담 신청</h4>
                <div class="row mt-5">
                    <div class=" col-md-12 col-sm-12 mt-3">
                        <div class="form-group ">
                            <div class="position-relative">
                                <label class="mb-2" for="">성명</label><span class="colored dot">.</span>
                            </div>

                            <input type="text" class="form-control" placeholder="" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $name }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12">
                        <div class="form-group ">
                            <div class="position-relative">
                                <label class="mb-2" for="business_number_field">연락처</label><span
                                    class="colored dot">.</span>
                            </div>
                            <input type="text" id="business_number_field" name="business_number" class="form-control"
                                placeholder="숫자만 입력해 주세요" required>
                            @error('business_number')
                                <div class="text-danger">{{ $business_number }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <div class="position-relative">

                                <label class="mb-2" for="representative_name_field">사업체명</label><span
                                    class="colored dot">.</span>
                            </div>
                            <input type="text" id="representative_name_field" name="representative_name"
                                class="form-control" placeholder="" required>
                            @error('business_number')
                                <div class="text-danger">{{ $business_number }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class=" col-md-12 col-sm-12  ">
                        <div class="form-group ">
                            <div class="position-relative">
                                <label class="mb-2" for="contact_field">사업자 등록번호</label><span class="colored dot">.</span>
                            </div>
                            <input type="text" id="contact_field" name="contact" class="form-control"
                                placeholder="숫자만 입력해 주세요" required>
                            @error('business_number')
                                <div class="text-danger">{{ $business_number }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class=" col-md-12 col-sm-12">
                        @include('bhub::sales.partials._date-time-picker', [
                            'min_time' => '09:00',
                            'max_time' => '18:00',
                            'interval' => 3,
                            'label' => '통화 가능 일시',
                        ])
                    </div>
                    <div class="col-md-12 col-sm-12 mt-4" style="display: flex">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terms_and_service"
                                id="term_service1">
                        </div>
                        <label class="form-check-label consent-label">
                            <p>[필수] 위 개인정보 수집, 이용에 동의합니다. <span class="colored agreement1" style="cursor: pointer;"> [내용보기] </span></p>
                        </label>
                    </div>
                    <div class="col-md-12 col-sm-12" style="display: flex">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="terms_and_service"
                                id="term_service2">
                        </div>
                        <label class="form-check-label consent-label">
                            <p>[필수] 위 개인정보 제3자 제공에 동의합니다. <span class="colored agreement2" style="cursor: pointer;"> [내용보기] </span></p>
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

                    <div class="col-md-12 col-sm-12 col-lg-12 mt-5 text-center">
                        <button id="submitBtn" type="submit" class="btn btn-color submit-btn bhub-submit-btn" disabled>상담 신청</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script>
        const term1 = document.getElementById('term_service1');
        const term2 = document.getElementById('term_service2');
        const formInputs = document.querySelectorAll('.rental-form input, .rental-form textarea');
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
            const formInputs = document.querySelectorAll('.rental-form input, .rental-form textarea');
            formInputs.forEach(function(input) {
                input.addEventListener('input', validateForm);
            });
            $('.rental-form').on('change', 'input[type="checkbox"]', function() {
                validateForm();
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