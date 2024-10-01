@extends('adminlte::master')

@php($dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home'))

@if (config('adminlte.use_route_url', false))
    @php($dashboard_url = $dashboard_url ? route($dashboard_url) : '')
@else
    @php($dashboard_url = $dashboard_url ? url($dashboard_url) : '')
@endif

@section('adminlte_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <style>
        .title-container {
            display: flex;
            justify-content: center;
            padding: 0px;
            margin-bottom: 20px;
            width: 100%;
        }

        .title {
            height: 29px;
            font-size: 24px;
            font-weight: 700;
            line-height: 28.64px;
            color: #373737;

        }

        .findID {
            background: #fff;
        }

        input[type=text],
        input[type=tel],
        input[type=number] {
            padding: 16px, 20px, 16px, 20px;
            border: 1px line #ECECEC;
            border-radius: 8px;
            height: 51px;
        }

        .form-certification input[type=text] {
            background-color: #F5F5F5;
        }

        form div {
            margin: 0px 0px;
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
            font-size: 14px;
            line-height: 19px;
            width: 87px;
            height: 19px;
            color: #646464;
        }

        /*

                                                                                                                                                                                                 */
        .find-id {
            padding: 16px 20px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            background: rgba(236, 102, 26, 0.08);
            border: none;
            width: 100%;
        }

        .find-id span {
            color: #646464;
            font-weight: 400px;
            font-size: 14px;
            line-height: 19.2px;
        }

        .form-control:focus {
            border-color: #373737;
            box-shadow: none;
        }

        .find-form {
            height: 95vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            width: 450px;
            margin: auto;
        }

        .form-group label {
            color: #373737;
        }

        .centerlize-both {
            min-height: 95vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .ti-check {
            color: #ec661a;
            background-color: rgb(236 102 26 / 17%);
            font-size: 60px;
            padding: 7px;
            border-radius: 100%;
            margin-bottom: 40px;
        }

        section#thankyou-info {
            background-color: #fff;
        }

        section#thankyou-info p span {
            color: #CF1322;
        }

        section#thankyou-info p {
            /* border: 1px solid #ddd; */
            padding: 10px 24px;
            line-height: 30px;
            margin-bottom: 10px;
            color: #373737;
            font-weight: 600;
            font-size: 16px;
        }

        section#thankyou-info h5 {
            font-size: 24px;
            font-weight: 700;
            line-height: 15px;
            color: #373737;
            text-align: center;
        }

        section#thankyou-info #code-parcial {
            color: #EC661A;
            font-size: 20px;
            font-weight: 700;
        }

        @media screen and (min-width: 1900px) {
            .form-container {
                max-width: 992px;
            }
        }

        button.btn-orange {
            color: #EC661A;
            background-color: #EC661A14;
            padding: 16px 20px 16px 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        button.btn-orange:hover {

            color: #EC661A;
            background-color: #EC661A14;
        }

        button.btn-primary-btn {
            background-color: #EC661A;
            color: #fff;
            padding: 16px 20px 16px 20px;
            border-radius: 8px;
        }

        button.btn-primary-btn:hover {
            background-color: #EC661A;
            color: #fff;
        }

        @media screen and (max-width: 767px) {
            .form-container {
                width: 100%;
            }
        }
    </style>
@stop

@section('classes_body'){{ ($auth_type ?? 'find-id') . '-page' }}@stop

@section('body')
    <section class="findID">
        <div class="container">
            <div class="centerlize-both">
                <div class="form-container">

                    <div class="title-container text-center">
                        <span class="title">아이디 찾기</span>
                    </div>
                    <form class="row g-3">
                        <div class="form-group col-md-12 mb-0">
                            <label for="name" class="text-center mb-2">이름</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="이름" required>
                        </div>
                        <div class="form-group col-md-12 mb-0" id="phone-section">
                            <label for="phone_number" class="text-center mb-2">휴대폰 번호</label>
                            <div class=" input-btn mt-0">
                                <input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="휴대폰 번호(- 없이 숫자만 입력)" style="padding-right: 36px;" required>
                                <button type="button" disabled class="btn btn-secondary text-dark send-otp-btn">인증번호 전송</button>
                                <button type="button" class="btn btn-secondary resend-btn d-none">재전송</button>
                            </div>
                            <div class="text-danger d-none error">Invalid !</div>
                        </div>
                        <div class="form-group  col-md-12 mb-0" id="otp-section">
                            <div class="input-btn mt-0 mb-2">
                                <div class="input-group input-group-merge disabled m-0">
                                    <input type="text" id="certification_number" class="form-control" name="certification_number" placeholder="인증번호 입력" disabled required aria-describedby="basic-addon33">
                                    <span class="input-group-text text-warning count_down" id="basic-addon33"></span>
                                </div>
                                <button type="button" disabled class="btn btn-secondary text-dark">인증확인</button>
                            </div>
                            <span class="error"></span>
                        </div>
                        <button type="button" disabled class="btn btn-warning form_submit" style="background-color: #EC661A" value="비밀번호 찾기"><span>아이디 찾기</span></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="thankyou-info" class="registration-section d-none">
        <div class="container">
            <div class="centerlize-both">
                <div class="form-container text-center">
                    <i class="ti ti-check"></i>
                    <h5 class="page_title mb-4">아이디 찾기 완료</h5>
                    <p>아이디 찾기가 완료되었습니다.</p>
                    <div id="code-parcial"></div>
                    <div class="my-4">
                        <button type="button" onclick="window.location.href='{{ route('find-password') }}'" class="btn btn-orange w-100">비밀번호 찾기</button>
                        <button type="button" onclick="window.location.href='{{ route('login') }}'" class="btn btn-primary-btn w-100">로그인</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('adminlte_js')
    @parent
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        $(document).ready(function() {

            let otpRequested = false; // Flag to track whether OTP has been requested

            $('.form_submit').click(function() {
                var is_verified = $('.count_down').attr('data-verified');
                if(!is_verified){
                    jQuery('#otp-section .error').text('인증번호를 확인해주세요.');
                    jQuery('#otp-section .error').removeClass('d-none');
                    return;
                }
                find_user_id(function(res) {
                    if (res.success && res.data.length != 0) {
                        $('.findID').addClass("d-none");
                        $('#thankyou-info').removeClass('d-none');
                        res.data.forEach(function(item){
                            var emailDiv = $('<div>').text(item.email);
                            $('#code-parcial').append(emailDiv);
                        });
                        return;
                    }
                    $('.text-danger').removeClass('d-none').text('사용자를 찾을 수 없습니다');
                });
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
                    $(this).next().attr('disabled', '');
                    $('#certification_number').prop('disabled', true);
                    $('#certification_number').parent().addClass('disabled');
                    $('#certification_number').parent().next().attr('disabled', '');
                }
            });

            function sendOTP() {
                verify_phone(function(res){
                    if (res.success) {
                        jQuery('#phone-section .error').addClass('d-none');
                        otpRequested = true;
                        send_otp(function(otp) {
                            if (otp.success) {
                                $('.send-otp-btn').attr('disabled',true);
                                $('.resend-btn').attr('disabled',true);
                                $('#certification_number').removeAttr('disabled');
                                $('#certification_number').parent().removeClass('disabled');
                                $('#certification_number').parent().next().removeAttr('disabled');

                                var duration = 2 * 60 + 10;
                                var timer = setInterval(function() {
                                    var minutes = Math.floor(duration / 60);
                                    var seconds = duration % 60;
                                    var is_verified = $('.count_down').attr('data-verified');
                                    if(!is_verified){
                                        $('.count_down').text(minutes + ' 분 ' + seconds + ' 초');
                                        duration--;
                                        if (duration < 0) {
                                            clearInterval(timer);
                                            $('.count_down').text('');
                                            $('#certification_number').parent().next().prop('disabled', true);
                                            $('#certification_number').prop('disabled', true);
                                            $('#certification_number').parent().addClass('disabled');
                                            $('.resend-btn').removeClass('d-none'); // Show resend button
                                            $('.resend-btn').attr('disabled',false);
                                            $('.send-otp-btn').addClass('d-none');
                                            $('#phone_number').next().addClass('d-none');
                                        }
                                    }
                                }, 1000);

                                $('#certification_number').parent().next().click(() => {
                                    verify_otp(function(res) {
                                        if (res.success) {
                                            clearInterval(timer);
                                            $('.count_down').attr('data-verified',true);
                                            $('.count_down').text('');
                                            $('.form_submit').prop('disabled', false);
                                            // console.log('here im verify otp');
                                            $('#certification_number').parent().next().prop('disabled', true);
                                        }
                                    });
                                });
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

                formData.append("name",  $('#name').val())
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
                let formData = new FormData($('.findID form')[0]);
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

            // Resend OTP button functionality
            $('.send-otp-btn').click(function() {
                $('.text-danger').addClass('d-none').text('');
                sendOTP();
            });
            $('.resend-btn').click(function() {
                sendOTP();
                // $(this).addClass('d-none'); // Hide the resend button again
                // $('#phone_number').next().removeClass('d-none'); // Hide the resend button again
            });
        });
    </script>
@stop
