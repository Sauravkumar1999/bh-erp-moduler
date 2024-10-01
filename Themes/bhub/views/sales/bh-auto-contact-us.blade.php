@extends('bhub::sales.master',['title'=>'BH Auto - 상담 신청'])
@section('css')
    <link rel="stylesheet" href="{{ themes('css/bh-auto-contact.css') }}">
    <style type="text/css">
        .input-with-checkbox label:hover {
            cursor: pointer;
        }
    </style>
    {!! htmlScriptTagJsApi() !!}
@endsection

@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div id="bh-consent">
        <!-- ======= Banner ======= -->
        <div id="consent_banner" class="d-flex align-items-center justify-content-center">
            <div class="col-md-4 text-md-end ">
                <h2 class="fw-bold main_title"> 상담 신청 </h2>
            </div>
            <div class="col-md-8 text-end text-md-center imageBox">
                <picture>
                    <source srcset="sourceset" type="image" />
                    <img src="{{ themes('images/bh-auto/car.png') }}" class="img-fluid car" alt="image desc" />
                </picture>
                <picture>
                    <source srcset="sourceset" type="image" />
                    <img src="{{ themes('images/bh-auto/logo.png') }}" class="img-fluid logo" alt="image desc" />
                </picture>

            </div>

        </div>
    </div>
    <section id="details">
        <div class="custom-consent">
            <div class="text-center text-title-1 text-nowrap">
                상담 신청
            </div>
        </div>
        <div class="custom-consent mt-2">
            <div class="text-center text-title desktop">[유의] <span class="text-title-2">상담 신청은 반드시 “비즈플래너(지사대표)” 로 등록되어
                    비즈플래너의<br> 본인 홈페이지에서 신청이 가능합니다.</span>(로그인 불필요)</div>
            <div class="text-center text-title mobile">[유의] <span class="text-title-2">상담 신청은 반드시 “비즈플래너(지사대표)”<br>로 등록되어
                    비즈플래너의 본인 홈페이지에서 신청이 가능합니다.</span>(로그인 불필요)</div>
        </div>
        <div class="custom-consent">
            <div class="text-center d-md-none text-title-1 pt-4 text-nowrap title2">
                상담 신청
            </div>
        </div>
    </section>
    <section id="cards">
        <div class="container custom-consent-card container-lg container-md mt-2">
            <div class="d-flex align-items-center justify-content-center " id="auto-contact-container">
                <form class="align-items-center auto-contact-form" action="{{ route('sales.auto-contact.send') }}"
                    method="POST">
                    {{-- <form class="align-items-center auto-contact-form" method="POST"> --}}
                    @csrf

                    <div class="row mt-5 formStyle">
                        <label class="form-check-label" for="product">상품 선택</label>
                        <div class="bd-example">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input hqr_checkbox_inp" type="radio" checked name="product"
                                    id="product_long_term_rental" value="장기렌터카">
                                <label class="form-check-label" for="product">장기렌터카</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input hqr_checkbox_inp" type="radio" name="product"
                                    id="product_auto_lease" value="오토리스">
                                <label class="form-check-label" for="product">오토리스</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input hqr_checkbox_inp" type="radio" name="product"
                                    id="product_cash_installment" value="현금 (할부)">
                                <label class="form-check-label" for="product">현금 (할부)</label>
                            </div>
                        </div>
                        <div class=" col-md-12 col-sm-12 mt-3">
                            <div class="form-group ">
                                <label class="mb-2" for="customer_name">고객명<b>*</b></label>
                                <input type="text" id="customer_name" name="customer_name" class="form-control"
                                    placeholder="비즈허브" required>
                                @error('customer_name')
                                    <div class="text-danger">{{ $customer_name }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label class="mb-2" for="customer_phone">휴대전화<b>*</b></label>
                                <input type="text" id="customer_phone" name="customer_phone" class="form-control"
                                    placeholder="01012345678" required>
                                @error('customer_phone')
                                    <div class="text-danger">{{ $customer_phone }}</div>
                                @enderror
                            </div>
                            <div class="input-with-checkbox">
                                <input type="checkbox" id="application_checkbox" name="terms_and_service"
                                    class="form-check-input">
                                <label onclick="location.href = '{{ route('sales.bh-consent') }}'">개인정보 수집, 및  제 3자 제공 동의
                                    [내용 보기] <span style="color: #EC661A">(필수)</span></label>
                            </div>
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
                            <button id="submitBtn" type="submit" class="btn btn-color submit-btn bhub-submit-btn" disabled>신청하기</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script>

        const formInputs = document.querySelectorAll('.auto-contact-form input, .auto-contact-form textarea');
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
            const app_check = document.getElementById('application_checkbox');
            formInputs.forEach(function(input) {
                if (input.required && input.value.trim() === '') {
                    isFormValid = false;
                }
            });
            const submitBtn = document.getElementById('submitBtn');

            if(app_check.checked === false) {
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
            $('.auto-contact-form').on('change', 'input[type="checkbox"]', function() {
                validateForm();
            });

            $('.auto-contact-form').on('change', 'select', function() {
                validateForm();
            });
        });
    </script>
@endsection
