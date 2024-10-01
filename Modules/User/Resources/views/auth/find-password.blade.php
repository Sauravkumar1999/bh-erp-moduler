@extends('adminlte::master')

@php($dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home'))

@if (config('adminlte.use_route_url', false))
    @php($dashboard_url = $dashboard_url ? route($dashboard_url) : '')
@else
    @php($dashboard_url = $dashboard_url ? url($dashboard_url) : '')
@endif

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <style>
        .stepper-container {
            margin: auto;
            margin-top: 5%;
        }

        .password-container {
            width: 100%;
            max-width: 450px;
            height: 453px;
            margin: auto;
            gap: 40px;

        }

        .title-container {
            display: flex;
            justify-content: center;
            padding: 0px;
            margin-bottom: 20px;
            width: 100%;
        }

        .title {
            /* width: 130px; */
            height: 29px;
            font-size: 24px;
            font-weight: 700;
            line-height: 28.64px;
            color: #373737;

        }

        input[type=password],
        input[type=email],
        input[type=text],
        input[type=tel],
        input[type=number] {
            padding: 16px, 20px, 16px, 20px;
            border: 1px line #ECECEC;
            border-radius: 8px;
            height: 51px;
            width: 100%;
        }

        .form-certification input[type=text] {
            background-color: #F5F5F5;
        }

        form div:not(.check-div) {
            margin: 20px 0px;
        }

        .iti--allow-dropdown{
            margin: 0px !important;
            width:100%;
        }
        .iti__flag-box .iti__flag {
            margin: 0;
        }
        .iti__flag-box, .iti__country-name{
            margin:0 !important;
            margin-right:6px !important;
        }
        .iti__flag-container {
            margin: 0px 0px !important;
        }

        .iti__selected-flag{
            margin: 0px !important;
        }

        .input-btn {
            display: flex;
            align-items: center;

        }

        .input-btn button {
            min-width: 111px;
            border: none;
            height: 51px;
            background-color: #F5F5F5;
            padding: 16px, 12px, 16px, 12px;
            border-radius: 8px;
            margin-left: 10px;
        }

        .btn-title {
            font-weight: 400px;
            font-size: 16px;
            line-height: 19px;
            /* width: 87px; */
            height: 19px;
            color: #646464;
        }

        .find-password,
        .change-password {
            padding: 16px 20px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            border: none;
            width: 100%;
        }

        .find-password {
            background: rgba(236, 102, 26, 0.08);
        }

        .change-password {
            background-color: #EC661A;
        }

        .change-password span {
            color: #fff;
            font-weight: 400px;
            font-size: 16px;
            line-height: 19.2px;
        }

        .find-password span {
            color: #EC661A;
            font-weight: 400px;
            font-size: 16px;
            line-height: 19.2px;
        }

        .form-control:focus {
            border-color: #373737;
            box-shadow: none;
        }

        .find-password-page {
            background-color: #fff;
        }

        #phone-section .input-btn {
            margin: 0;
        }

        @media (max-width: 768px) {
            .password-container {
                width: 100%;
                height: 453px;
                margin: auto;
                margin-top: 20%;
                gap: 40px;
            }
        }
    </style>

    <style>
        .bs-stepper {
            box-shadow: none !important;
        }

        .bs-stepper-header {
            position: relative;
            max-width: 800px;
        }

        .bs-stepper-header::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 65%;
            height: 2px;
            transform: translate(-50%, -50%);
            z-index: 1;
            background-color: #DBDADE;
        }

        .bs-stepper-header .step {
            position: relative;
            z-index: 3;
        }

        .bs-stepper-circle {
            color: #fff !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            width: 28px !important;
            height: 28px !important;
            border-radius: 100px !important;
        }

        .primary-heading {
            font-size: 28px;
            font-weight: 700;
            color: #2B2B2B;
            text-align: center;
        }

        .bs-stepper .step.crossed button.step-trigger span.bs-stepper-circle {
            color: green !important;
        }

        .bs-stepper button.step-trigger[aria-selected="false"] span.bs-stepper-circle:hover {
            background-color: #b2b0b3 !important;
        }

        .bs-stepper button.step-trigger[aria-selected="true"] span.bs-stepper-circle:hover {
            color: blue !important;
        }

        .first-three-steps-container {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
        }

        .checkbox-password-change-container {
            margin-top: 10px;
            display: inline-block;
        }

        @media (max-width: 768px) {
            .bs-stepper-header::after {
                content: "";
                position: absolute;
                top: 50%;
                left: 50%;
                width: 50%;
                height: 2px;
                transform: translate(-50%, -50%);
                z-index: 1;
                background-color: #DBDADE;
            }

            .form-check-inline {
                margin-right: 0 !important;
                padding-left: 0.5em !important;
            }
        }

        @media (max-width: 991.98px) {
            .bs-stepper .bs-stepper-header .step:first-child .step-trigger {
                padding: 0.5rem 0;
            }
        }

        .password-checkbox {
            position: relative;
        }

        .password-checkbox input[type="checkbox"] {
            position: absolute;
            left: 2px;
            top: 5px;
            width: 17px;
            height: 17px;
            opacity: 0;
        }

        .ti-check {
            color: #52C41A;
            background-color: rgb(236 102 26 / 17%);
            font-size: 74px;
            padding: 7px;
            border-radius: 100%;
            margin-bottom: 40px;
        }

        #password-find-step3 .ti-check {
            color: #ec661a;
        }

        .form-container {
            width: 450px;
            margin: auto;
        }

        button.btn-primary-btn {
            margin-top: 52px;
            background-color: #EC661A;
            color: #fff;
        }

        .btn:not([class*=btn-label-]):not([class*=btn-outline-]) {
            box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
        }

        .checkbox-password-change-container.password-checkbox .check-div svg {
            color: #BFBFBF;
            margin-top: 0 !important;
            font-size: 18px !important;
        }

        .checkbox-password-change-container.password-checkbox .check-div svg.error path {
            fill: #BFBFBF;
        }

        .checkbox-password-change-container.password-checkbox .check-div svg.valid path {
            fill: #52C41A;
        }

        .checkbox-password-change-container.password-checkbox .check-div svg.invalid path {
            fill: red;
        }

        .checkbox-password-change-container.password-checkbox {
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .checkbox-password-change-container.password-checkbox .form-check-label {
            margin-bottom: 0;
        }

        .checkbox-password-change-container.password-checkbox .check-div {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .input-group.disabled .input-group-text {
            background-color: rgba(75, 70, 92, 0.08);
        }

        .form-group label {
            margin-bottom: 8px;
        }

        #otp-section input:disabled {
            background-color: rgba(75, 70, 92, 0.08);
        }

        #password-find-step3 h5 {
            font-size: 24px;
            font-weight: 700;
            line-height: 15px;
            color: #373737;
            text-align: center;
        }

        #password-find-step3 p {
            padding: 0px;
            line-height: 30px;
            margin-bottom: 0px;
            color: #373737;
            font-weight: 600;
            font-size: 16px;
        }
    </style>
@stop

@section('classes_body'){{ ($auth_type ?? 'find-password') . '-page' }}@stop

    <style>

    </style>

@section('body')
    <div class="container">
        <div class="stepper-container">
            <div class="steps-find-password-container">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="primary-heading py-3 mt-4 mb-3 text-center" id="findPasswordHeading">
                            비밀번호 찾기
                        </h4>
                        <div id="stepper" class="bs-stepper linear">
                            <div class="bs-stepper-header m-auto d-flex justify-content-evenly d-none"
                                style="visibility: none;">
                                <div class="first-three-steps-container w-100">
                                    <div class="step" data-target="#password-find-step1">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle">1</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#password-find-step2">
                                        <button class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle">2</span>
                                        </button>
                                    </div>
                                    <div class="line"></div>
                                    <div class="step" data-target="#password-find-step3">
                                        <button type="button" class="btn step-trigger" disabled>
                                            <span class="bs-stepper-circle">3</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                {{-- Find Password Step 1::begin --}}
                                <div id="password-find-step1" class="content">
                                    <div class="password-container" id="find-password-one">
                                        <form id="password_find_step1_form">
                                            <div class="form-group">
                                                <label for="id">아이디</label>
                                                <input type="email" class="form-control" placeholder="아이디" id="id"
                                                    name="id" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">이름</label>
                                                <input type="text" id="name" class="form-control" name="name"
                                                    placeholder="이름">
                                            </div>

                                            <div class="form-group" id="phone-section" style="margin: 0px">
                                                <label for="phone_number">휴대폰 번호</label>
                                                <div class="input-btn">
                                                    <input type="tel" id="phone_number" name="phone_number" style="padding-right: 36px;"
                                                        class="form-control" placeholder="휴대폰 번호(- 없이 숫자만 입력)" required>
                                                    <button type="button" disabled
                                                        class="btn btn-secondary text-dark send-otp-btn">인증번호 전송</button>
                                                    <button type="button"
                                                        class="btn btn-secondary resend-btn d-none">재전송</button>
                                                </div>
                                                <div class="text-danger d-none error">Invalid !</div>
                                            </div>

                                            <div class="form-group" id="otp-section">
                                                <div class="input-btn mt-0 mb-2">
                                                    <div class="input-group input-group-merge disabled m-0">
                                                        <input type="text" id="certification_number" class="form-control"
                                                            name="certification_number" placeholder="인증번호 입력" disabled
                                                            required aria-describedby="basic-addon33">
                                                        <span class="input-group-text text-warning count_down"
                                                            id="basic-addon33"></span>
                                                    </div>
                                                    <button type="button" disabled
                                                        class="btn verify-otp-btn btn-secondary text-dark">인증확인</button>
                                                </div>
                                                <div class="error"></div>
                                            </div>

                                            <button class="find-password" disabled type="submit" value="비밀번호 찾기"><span>비밀번호
                                                    찾기</span></button>
                                        </form>
                                    </div>
                                </div>
                                {{-- Find Password Step 1::end --}}

                                {{-- Find Password Step 2::begin --}}
                                <div id="password-find-step2" class="content">
                                    <div class="password-container" id="find-password-one">
                                        <form id="password_find_step2_form">
                                            <input type="hidden" name="user_id" id="user_id">
                                            <div class="form-password-toggle mb-0">
                                                <label class="form-label" for="password">비밀번호</label>
                                                <div class="input-group input-group-merge my-0">
                                                    <input type="password" class="form-control"
                                                        placeholder="비밀번호 입력해 주세요." id="password" name="password"
                                                        required aria-describedby="12password">
                                                    <span class="input-group-text cursor-pointer" id="12password"><i
                                                            class="ti ti-eye-off"></i></span>
                                                </div>
                                            </div>
                                            <div class="checkbox-password-change-container password-checkbox mb-2">
                                                <div class="check-div english_included" style="padding-left: 0px">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="english_included" id="english_included" value=""
                                                        disabled>
                                                    <svg class="error" xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 16 16" fill="none">
                                                        <path
                                                            d="M11.4425 4.685L6.5 9.6275L3.8075 6.9425L2.75 8L6.5 11.75L12.5 5.75L11.4425 4.685ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.685 14 2 11.315 2 8C2 4.685 4.685 2 8 2C11.315 2 14 4.685 14 8C14 11.315 11.315 14 8 14Z"
                                                            fill="#52C41A" />
                                                    </svg>
                                                    <label class="form-check-label" for="english_included">영문포함</label>
                                                </div>
                                                <div class="check-div numbers_included">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="numbers_included" id="numbers_included" value=""
                                                        disabled>
                                                    <svg class="error" xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 16 16" fill="none">
                                                        <path
                                                            d="M11.4425 4.685L6.5 9.6275L3.8075 6.9425L2.75 8L6.5 11.75L12.5 5.75L11.4425 4.685ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.685 14 2 11.315 2 8C2 4.685 4.685 2 8 2C11.315 2 14 4.685 14 8C14 11.315 11.315 14 8 14Z"
                                                            fill="#52C41A" />
                                                    </svg>
                                                    <label class="form-check-label" for="numbers_included">숫자포함</label>
                                                </div>
                                                <div class="check-div characters">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="characters_8_to_16 " id="characters_8_to_16" value=""
                                                        disabled>
                                                    <svg class="error" xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 16 16" fill="none">
                                                        <path
                                                            d="M11.4425 4.685L6.5 9.6275L3.8075 6.9425L2.75 8L6.5 11.75L12.5 5.75L11.4425 4.685ZM8 0.5C3.86 0.5 0.5 3.86 0.5 8C0.5 12.14 3.86 15.5 8 15.5C12.14 15.5 15.5 12.14 15.5 8C15.5 3.86 12.14 0.5 8 0.5ZM8 14C4.685 14 2 11.315 2 8C2 4.685 4.685 2 8 2C11.315 2 14 4.685 14 8C14 11.315 11.315 14 8 14Z"
                                                            fill="#52C41A" />
                                                    </svg>
                                                    <label class="form-check-label" for="characters_8_to_16">8~16자</label>
                                                </div>
                                            </div>
                                            <div class="form-password-toggle password_confirm">
                                                <label class="form-label" for="password_confirm">비밀번호 재확인</label>
                                                <div class="input-group input-group-merge my-0">
                                                    <input type="text" id="password_confirm" class="form-control"
                                                        name="password_confirm" placeholder="비밀번호를 재입력해 주세요." required
                                                        aria-describedby="123password">
                                                    <span class="input-group-text cursor-pointer" id="123password">
                                                        <i class="ti ti-eye"></i></span>
                                                </div>
                                                <div class="error d-none">비밀번호가 일치하지 않습니다</div>
                                            </div>

                                            <button class="change-password" type="submit" value="비밀번호 찾기"><span>비밀번호
                                                    찾기</span></button>
                                        </form>
                                    </div>
                                </div>
                                {{-- Find Password Step 2::end --}}

                                {{-- Find Password Step 3::begin --}}
                                <div id="password-find-step3" class="content">
                                    <div class="container">
                                        <div class="centerlize-both">
                                            <div class="form-container text-center">
                                                <i class="ti ti-check"></i>
                                                <h5 class="page_title mb-4">비밀번호 변경 완료</h5>
                                                <p>비밀번호 변경이 완료되었습니다.</p>
                                                <p>새로운 비밀번호로 로그인해 주세요.</p>
                                                <div class="my-4">
                                                    <button type="button"
                                                        onclick="window.location.href='{{ route('login') }}'"
                                                        class="btn btn-primary-btn w-100">다음</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Find Password Step 3::end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"
        integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script>
        $("#phone_number").intlTelInput({
            initialCountry: "kr",
            separateDialCode: true,
        });
    </script>
    <script>
        let otpRequested = false; // Flag to track whether OTP has been requested
        var stepperEl = document.getElementById('stepper')
        let stepper = new Stepper(stepperEl, {
            linear: true,
            animation: true,
        })

        stepperEl.addEventListener('show.bs-stepper', function(event) {
            if (event.detail.indexStep == 0) {
                $('#findPasswordHeading').html('비밀번호 찾기');
            } else if (event.detail.indexStep == 1) {
                $('#findPasswordHeading').html('비밀번호 변경');

            } else if (event.detail.indexStep == 2) {
                $('#findPasswordHeading').html('');
            }
        })

        $('#password_find_step1_form').on('submit', function(event) {
            event.preventDefault();
            var is_verified = $('.count_down').attr('data-verified');
            if (!is_verified) {
                jQuery('#otp-section .error').text('인증번호를 확인해주세요.');
                jQuery('#otp-section .error').removeClass('d-none');
                return;
            }
            find_user_id(function(res) {
                if (res.success) {
                    $('#user_id').val(res.data.id);
                    stepper.next();
                    return;
                }
                $('.text-danger').removeClass('d-none').text('사용자를 찾을 수 없습니다');
            });

        });
        $('#password_find_step2_form').on('submit', function(event) {
            event.preventDefault();
            if (jQuery('.password-checkbox svg').hasClass('error')) {
                jQuery('.password-checkbox svg.error').addClass('invalid');
                return;
            }
            if (jQuery('#password').val() != jQuery('#password_confirm').val()) {
                jQuery('.password_confirm .error').removeClass('d-none');
                return;
            }
            reset_password(function(res) {
                if (res.success) {
                    stepper.next();
                }
            })
        });
        $('.send-otp-btn').click(function() {
            sendOTP();
        });
        $('.resend-btn').click(function() {
            sendOTP();
        });

        $('#phone_number').on('keyup', function() {
            jQuery('#phone-section .error').addClass('d-none');
            jQuery('#otp-section .error').addClass('d-none');
            var phoneNumber = $(this).val();
            var phoneNumberRegex = /^[\d-+]{10,20}$/;

            if (!otpRequested && phoneNumberRegex.test(phoneNumber)) {
                $('.text-danger').addClass('d-none').text('');
                $(this).addClass('is-valid');
                $(this).removeClass('is-invalid');
                $(".send-otp-btn").removeAttr('disabled');
            } else {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
                $(".send-otp-btn").attr('disabled','');
                $('#certification_number').prop('disabled', true);
                $('#certification_number').parent().addClass('disabled');
                $('#certification_number').parent().next().attr('disabled', '');
            }
        });

        $('#password_confirm').on('keyup', function() {
            if (jQuery('#password').val() != jQuery(this).val()) {
                jQuery('.password_confirm .error').removeClass('d-none');
            } else {
                jQuery('.password_confirm .error').addClass('d-none');
            }
        })
        $('#password').on('keyup', function() {
            jQuery('.password-checkbox svg.error').removeClass('invalid');
            $('.password-checkbox svg').removeClass('valid');
            $('.password-checkbox svg').removeClass('error');
            var password = $(this).val();
            // Check password length
            if (password.length >= 8 && password.length <= 16) {
                $('.characters svg').addClass('valid');
            } else {
                $('.characters svg').addClass('error');
            }

            // Check if password contains at least one lowercase letter
            if (/[a-z]/.test(password)) {
                $('.english_included svg').addClass('valid');
            } else {
                $('.english_included svg').addClass('error');
            }
            // Check if password contains at least one digit
            if (/[0-9]/.test(password)) {
                $('.numbers_included svg').addClass('valid');
            } else {
                $('.numbers_included svg').addClass('error');
            }

        });

        function sendOTP() {
            verify_phone(function(res) {
                if (res.success) {
                    jQuery('#phone-section .error').addClass('d-none');
                    otpRequested = true;
                    send_otp(function(otp) {
                        if (otp.success) {
                            $('.send-otp-btn').attr('disabled', true);
                            $('.resend-btn').attr('disabled', true);
                            $('#certification_number').removeAttr('disabled');
                            $('#certification_number').parent().removeClass('disabled');
                            $('#certification_number').parent().next().removeAttr('disabled');

                            var duration = 2 * 60 + 10;
                            var timer = setInterval(function() {
                                var minutes = Math.floor(duration / 60);
                                var seconds = duration % 60;
                                var is_verified = $('.count_down').attr('data-verified');
                                if (!is_verified) {
                                    $('.count_down').text(minutes + ' 분 ' + seconds + ' 초');
                                    duration--;
                                    if (duration < 0) {
                                        clearInterval(timer);
                                        $('.count_down').text('');
                                        $('#certification_number').parent().next().prop('disabled',
                                            true);
                                        $('#certification_number').prop('disabled', true);
                                        $('#certification_number').parent().addClass('disabled');
                                        $('.resend-btn').removeClass('d-none'); // Show resend button
                                        $('.resend-btn').attr('disabled', false);
                                        $('.send-otp-btn').addClass('d-none');
                                    }
                                }
                            }, 1000);

                            $('#certification_number').parent().next().click(() => {
                                verify_otp(function(res) {
                                    if (res.success) {
                                        clearInterval(timer);
                                        $('.count_down').attr('data-verified', true);
                                        $('.count_down').text('');
                                        $('.verify-otp-btn').text('검증됨');
                                        $('.verify-otp-btn').attr('disabled',true);
                                        $('.form_submit').prop('disabled', false);
                                        $('.find-password').prop('disabled', false);
                                    }
                                });
                            });
                        }else{
                            otpRequested = false;
                        }
                    });
                }
                if (res.error) {
                    jQuery('#phone-section .error').removeClass('d-none');
                    jQuery('#phone-section .error').text('전화번호를 찾을 수 없습니다.');

                }
            })

        }

        function send_otp(callback) {
            let url = "{{ route('send-otp') }}";
            let formData = new FormData(); // Serialize form data
            var get_code = $(".iti__selected-dial-code").text().split("+")
            var phn = get_code[1] + $("#phone_number").val()

            formData.append("name", $("#name").val())
            formData.append("id", $("#id").val())
            formData.append("phone_number",  phn)
            $.ajax({
                type: "POST",
                url: url,
                data: formData, // Send serialized form data
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (typeof callback === 'function') {
                        callback(response);
                    }
                }
            });

        }

        function verify_phone(callback) {
            let url = "{{ route('verify-phone') }}";
            let formData = new FormData($('form')[0]); // Serialize form data
            formData.append('type', 'find-password');
            $.ajax({
                type: "POST",
                url: url,
                data: formData, // Send serialized form data
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (typeof callback === 'function') {
                        callback(response);
                    }
                }
            });

        }

        function reset_password(callback) {
            let url = "{{ route('reset-password') }}";
            let formData = new FormData($('#password_find_step2_form')[0]); // Serialize form data

            $.ajax({
                type: "POST",
                url: url,
                data: formData, // Send serialized form data
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (typeof callback === 'function') {
                        callback(response);
                    }
                }
            });
        }

        function verify_otp(callback) {
            let url = "{{ route('verify-otp') }}";
            let formData = new FormData($('form')[0]); // Serialize form data
            $.ajax({
                type: "POST",
                url: url,
                data: formData, // Send serialized form data
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (typeof callback === 'function') {
                        callback(response);
                    }
                }
            });

        }

        function find_user_id(callback) {
            let url = "{{ route('find-user-id') }}";
            let formData = new FormData($('form')[0]); // Serialize form data
            formData.append('type', 'find-password');
            $.ajax({
                type: "POST",
                url: url,
                data: formData, // Send serialized form data
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (typeof callback === 'function') {
                        callback(response);
                    }
                }
            });

        }
    </script>
@stop
