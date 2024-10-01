@extends('bhub::sales.master',['title'=>'면역세포, 줄기세포, 미토콘드리아'])

@section('css')
    <link rel="stylesheet" href="{{ themes('css/bio-tech.css') }}">
    {!! htmlScriptTagJsApi() !!}
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="biotech__header">
        <h1>면역세포, 줄기세포, 미토콘드리아</h1>
        <img src="{{ themes('images/bio-tech-header.svg') }}">
    </div>
    <div class="biotech__container">
        <div class="biotech__content__section">
            <div class="biotech__section__header">
                <span>첨단 바이오 기술을 통해 건강한 미래를 만듭니다.</span>
                <h2>구체적인 상담이 필요하신 분들은 아래에서 문의 주세요.</h2>
            </div>
            <div class="biotech__section__body">
                <div class="biotech__list-item">
                    <h4>면역 세포 (Immune Cell)</h4>
                    <div class="biotech__list-item-inner-content">
                        <div class="biotech__list-item-inner-img">
                            <img src="{{ themes('images/bio-tech-1.png') }}">
                        </div>
                        <p>
                            면역은 외부물질 또는 자기유래물질로부터 자기 신체를 보호하는 시스템으로, 외부물질을 제거하고이를 통하여 후천 면역을 획득하며, 암세포 등을 제거하여 건강한 신체를
                            유지할 수 있도록 합니다. 면역 시스템이 정상적으로 작동하지 않는 경우 만성 감염병이나 암 등의 질환이 발생하고, 면역계의 균형이 깨지면 알레르기나 자가면역질환 등이
                            발생합니다. 면역세포는 선천성면역에 관여하는 대식세포, NK세포와 후천성면역에 관여하는 T세포, B세포 그리고 모든 면역에 관여하는 수지상세포, 감마델타T세포 등이
                            있습니다.
                        </p>
                    </div>
                </div>
                <div class="biotech__list-item">
                    <h4>줄기세포 (Stem Cell)</h4>
                    <div class="biotech__list-item-inner-content">
                        <div class="biotech__list-item-inner-img">
                            <img src="{{ themes('images/bio-tech-2.png') }}">
                        </div>
                        <p>
                            줄기세포란 완전하게 분화되지 않은 미분화 세포로 우리 신체를 이루는 기관이나 조직의 세포로
                            분화할 수 있는 능력을 가진 세포를 말합니다.
                            줄기세포는 세포분열 및 분화를 통해 우리 신체를 이루는 뇌, 피부, 연골, 뼈, 신경 그리고 근육 등
                            다양한 기관과 조직을 만들거나 손상된 기관이나 조직을 재생 시킬 수 있습니다.
                        </p>
                    </div>
                </div>
                <div class="biotech__list-item">
                    <h4>미토콘드리아 (Mitochondria)</h4>
                    <div class="biotech__list-item-inner-content">
                        <div class="biotech__list-item-inner-img">
                            <img src="{{ themes('images/bio-tech-3.png') }}">
                        </div>
                        <p>
                            미토콘드리아는 세포 내 소기관 중 하나로 세포 내에서 필요한 에너지를 합성하는 기관으로 알려져 있습니다. 또한 미토콘드리아는 최근에 노화, 질병 등 생로병사의 열쇠로
                            건강한 삶을 유지하는데 중요한 기관으로 알려져 있습니다.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="biotech__form__container">
        <div class="biotech__inner__section">
            <h3>상담 신청</h3>
            <form id="bio_tech_form" class="bio_tech_form" action="#" method="POST">
                @csrf
                <div class="form__group">
                    <label>성명<sup>*</sup></label>
                    <input type="text" placeholder="" name="business_name" required />
                    @error('business_name')
                        <div class="text-danger">{{ $business_name }}</div>
                    @enderror
                </div>
                <div class="form__group">
                    <label>연락처<sup>*</sup></label>
                    <input type="text" placeholder="숫자만 입력해 주세요" name="contact" required />
                    @error('contact')
                        <div class="text-danger">{{ $contact }}</div>
                    @enderror
                </div>

                @include('bhub::sales.partials._date-time-picker', [
                    'min_time' => '09:00',
                    'max_time' => '18:00',
                    'interval' => 3,
                    'label' => '통화 가능 일시',
                ])
                <div class="form__group">
                    <label>상담분야<sup>*</sup> <small>(해당 내용을 선택해 주세요)</small></label>
                    <div class="form__group-checkbox-wrapper consultation">
                        <label>
                            건강/항노화
                            <input type="checkbox" name="health_anti_aging" value="1" />
                        </label>
                        <label>
                            질병/치료
                            <input type="checkbox" name="disease_treatment" value="1" />
                        </label>
                        <label>
                            미용/뷰티
                            <input type="checkbox" name="beauty_care" value="1" />
                        </label>
                        <label>
                            기타
                            <input type="checkbox" name="others" value="1" />
                        </label>
                    </div>
                </div>
                <label class="form__inline-checkbox"> <input type="checkbox" name="terms_and_service1"
                        id="term_service1" /> [필수] 위 개인정보 수집, 이용에 동의합니다. <span class="colored agreement1" style="cursor: pointer;"> [내용보기] </span></label>
                <label class="form__inline-checkbox"> <input type="checkbox" name="terms_and_service2"
                        id="term_service2" /> [필수] 위 개인정보 제3자 제공에 동의합니다. <span class="colored agreement2" style="cursor: pointer;"> [내용보기] </span></label>
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
                <div class="text-center mb-5">
                    <button type="submit" class="form__submit__btn btn bhub-submit-btn" id="submitBtn" disabled>신청하기</button>
                </div>
            </form>
        </div>
    </div>
    @php
        $currentTime = strtotime('+3 hours');
    @endphp
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const formInputs = document.querySelectorAll('.bio_tech_form input, .bio_tech_form textarea');
        const term1 = document.getElementById('term_service1');
        const term2 = document.getElementById('term_service2');

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
            var fields = $('.consultation input[type="checkbox"]:checked').length;

            if (yearSelect.value === '' || monthSelect.value === '' || daySelect.value === '' || hourSelect
                .value === '' ||
                hourSelect.value == '시간선택' || term1.checked === false || term2.checked === false || fields === 0) {
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
            $('.bio_tech_form').on('change', 'select', function() {
                validateForm();
            });

            $('.bio_tech_form').on('change', 'input[type="checkbox"]', function() {
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