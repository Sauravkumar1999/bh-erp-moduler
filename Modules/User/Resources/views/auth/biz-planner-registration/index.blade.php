@extends('user::auth.biz-planner-registration.layouts.master-layout')
@section('content')
    @if (setting('nice_authentication', 1))
        @inject('niceVerifyService', 'Modules\Core\Services\NiceVerifyService')
    @endif
    <style>
        *{
            box-sizing: border-box;
        }
        label.error {
            display: none !important;
            margin-top: 0.25rem;
            font-size: .875em;
            color: #dc3545;
        }

        .img-preview {
            float: left;
            width: 65px;
            height: 60px;
            border: 1px solid #DBDADE;
            padding: 1px;
        }

        .swal2-actions {
            width: 50% !important;
        }
        .required{
            color: red;
        }
        .check-button {
            background-color: #EC661A;
            color: #fff;
            border-color: #ff9f43;
            width: 80px;
            padding: 5px 10px;
            border-radius: 6px;
            transition: all 0.135s ease-in-out;
            transform: scale(1.001);
        }
        .check-button:hover {
            color: #fff !important;
            background-color: #e68f3c !important;
            border-color: #e68f3c !important;
        }
        .card-id-img{
            gap: 25px;
        }
        .card-id-img div{
            flex-basis: 100%;
        }
        .card-id-img .browse-btn{
            flex-basis: 35%
        }
        @media screen and (max-width: 1194px){
            .card-id-img div label{
            margin-left: 0px !important;
        }
        /* .pl-mb{
            padding-left: 0px;
        } */
        }
        @media screen and (max-width: 767px){
            .card-id-img{
                flex-direction: column;
                margin-bottom: 20px;
            }
            .card-id-img div{
            flex-basis: 100%;
        }
        .card-id-img div label{
            margin-left: 0px !important;
        }
        .card-id-img .browse-btn{
            flex-basis: 100%;
            margin-top: 0px !important;
        }
        .pl-mb{
            padding-left: 0px;
        }
        .card-id-img{
            gap: 10px;
        }
        }
    </style>
    <section id="registration-section" class="p-5">
        <div id="card" class="">
            <div id="card-body" class="pb-5">

                <div class="justify-content-center row">
                    <div class="col-md-12 col-xl-10 col-xs-12 px-xl-0">

                        <div data-bs-spy="scroll" class="scrollspy-example steps-registration-container">
                            <h4 class="primary-heading py-3 mt-4 mb-3" id="registerheading">
                                지사대표(BP) 등록
                            </h4>

                            <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
                                <div class="bs-stepper-header m-auto border-0 py-4">
                                    <div class="step" data-target="#privacy-agreement">
                                        <button type="button" class="step-trigger btn-unseleted btn-selected">
                                            <span class="bs-stepper-label">1</span>
                                        </button>
                                    </div>
                                    @if (setting('nice_authentication', 1))
                                        <div class="step" data-target="#member-info">
                                            <button type="button" class="step-trigger btn-unseleted">
                                                <span class="bs-stepper-label">2</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="step" data-target="#checkout-payment">
                                        <button type="button" class="step-trigger btn-unseleted">
                                            <span
                                                class="bs-stepper-label">{{ setting('nice_authentication', 1) ? 3 : 2 }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-------------------------------------------------------------------- Privacy Agreement Section   Start --------------------------------------------------------->
                        <section id="privacy-agreement" class="registration-section">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="pt-3">

                                        <h5 class="page_title mb-3">
                                            <span>1. </span> 이용약관/개인정보/영업 위탁 판매 규정 동의
                                        </h5>

                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header d-flex align-items-center justify-content-between"
                                                    id="flush-headingOne">
                                                    <span class="privacy-check d-flex align-items-center"><input
                                                            type="checkbox" id="check-all-term"><i
                                                            class="ti ti-circle-check me-1"></i>모두 확인, 동의합니다.</span>
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">

                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <div class="d-flex justify-content-between">
                                                            <span class="d-block w-80"><span
                                                                    class="privacy-check-inner"><input type="checkbox"
                                                                        class="term-check"><i
                                                                        class="ti ti-circle-check me-1"></i></span> (필수)
                                                                비즈니스허브 이용약관</span><a
                                                                href="{{route('terms')}}#terms-of-use-tab">
                                                                내용 보기
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="d-block w-80"><span
                                                                    class="privacy-check-inner"><input type="checkbox"
                                                                        class="term-check"><i
                                                                        class="ti ti-circle-check me-1"></i></span> (필수)
                                                                개인정보 수집 및 이용 동의</span><a
                                                                href="{{route('terms')}}#personal-information-collection-tab">
                                                                내용 보기
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="d-block w-80"><span
                                                                    class="privacy-check-inner"><input type="checkbox"
                                                                        class="term-check"><i
                                                                        class="ti ti-circle-check me-1"></i></span> (필수)
                                                                개인정보 제 3자 제공 동의</span><a
                                                                href="{{route('terms')}}#consent-to-provision-of-personal-info-tab">
                                                                내용 보기
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="d-block w-80"><span
                                                                    class="privacy-check-inner"><input type="checkbox"
                                                                        class="term-check"><i
                                                                        class="ti ti-circle-check me-1"></i></span> (필수) 영업
                                                                위탁 판매 규정 동의</span><a
                                                                href="{{route('terms')}}#business-consignment-sales-regulation-tab">
                                                                내용 보기
                                                            </a>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="d-flex w-80"><span
                                                                    class="privacy-check-inner"><input type="checkbox"
                                                                        class="term-check"><i
                                                                        class="ti ti-circle-check me-1"></i></span>
                                                                <span>(필수) 휴대전화, 이메일, 문자 수신에 대한 동의<br>*지사대표(BP)는 직책 성격 상
                                                                    휴대전화, 이메일, 문자 수신 미동의 시 등록이 불가합니다.</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="shade-orange btn mt-5 ">
                                            다음
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-------------------------------------------------------------------- Privacy Agreement Section  End ------------------------------------------------------------>

                        <!----------------------------------------------------------------------identity-verification Section  start ------------------------------------------------------>
                        @if (setting('nice_authentication', 1))
                            <section id="identity-verification" class="registration-section">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="pt-3">
                                            <h5 class="page_title mb-4">
                                                <span>1. </span> 본인인증
                                            </h5>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <p class="mb-0">(주)비즈니스허브의 “지사대표(BP)” 등록은, 개인정보 유출 및 도용을 방지하기 위해 본인
                                                        인증을
                                                        시행하고 있습니다.</p>
                                                </div>

                                            </div>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <p class="mb-0">정보통신망 이용 촉진 및 정보보호 등에 관한 법률 제23조 2 (주민등록번호의 사용 제한)에
                                                        의거하여
                                                        홈페이지 내 주민등록번호 수집ㆍ이용이 금지되어 주민번호 입력 기반의 인증서비스 사용이 제한됩니다.</p>
                                                </div>

                                            </div>
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <p class="mb-0">(주)비즈니스허브의 “비즈 플래너(BP)”로 등록하기 위해서는 <span>이용약관 및 개인정보
                                                            수집동의</span>를 읽고
                                                        동의하셔야 합니다.</p>
                                                </div>

                                            </div>
                                            <div class="row mt-2">
                                                <div class="d-flex justify-content-start authentication-button">
                                                    <div class="d-grid gap-2 col-12">
                                                        <button id="mobile-auth"
                                                            class="btn-primary-btn member-info w-100">휴대폰 본인 인증</button>
                                                        <input type="hidden" name="nice-data">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3 mb-5 list">
                                                <ul>
                                                    <li>휴대폰 인증을 통해 본인 인증을 진행하여 주시기 바랍니다.</li>
                                                    <li>휴대폰 인증이 불가한 경우 고객센터 {{ setting('bh_telephone', '') }} (평일 10:00~17:00)로 연락주시면 등록 지원합니다.</li>
                                                    <li>본인 인증은 NICE 본인 확인 서비스를 통해 받고 있으며, 안전한 방법을 통해 본인 인증을 확인하고 있습니다.</li>
                                                    <li>본인 인증시 입력하신 정보는 본인 인증을 위해서만 사용할 뿐 따로 저장되지 않습니다.</li>
                                                </ul>
                                                <button class="shade-orange btn mt-5 next-page">
                                                    다음
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                        <!----------------------------------------------------------------------identity-verification Section  End -------------------------------------------------------->

                        <!------------------------------------------------------------------------member-info Section  start---------------------------------------------------------------->
                        <section id="member-info" class="registration-section">
                            <div class="form-container">
                                <h5 class="page_title mb-4">
                                    <span>1. </span> 회원 정보 입력
                                </h5>
                                <form id="step-2-form" type="POST">
                                    @csrf
                                    <div class="mb-3 row email-row">
                                        <label class="col-sm-12 form-label">아이디(이메일) <span class="required">*</span></label>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-xs-12 input-container">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="예) businesshub@planner.com">
                                            <input type="text" name="email_available" class="d-none">
                                            <span id="error_email" class="invalid-feedback"></span>
                                        </div>
                                        <div class="col-xs-12 col-md-4 col-xl-2 col-lg-4 btn-container">
                                            <button id="email-validate" type="button"
                                                class="btn btn-primary-btn mt-space">중복 확인 </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="label-1" class="form-label">성명 <span class="required">*</span></label>
                                                <input type="text" name="name" id="nice_auth_name"
                                                    {{ setting('nice_authentication', 1) ? 'readonly' : '' }}
                                                    class="form-control {{ setting('nice_authentication', 1) ? 'disabled' : '' }}"
                                                    placeholder="성명을 작성해 주세요.">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 passwod-eye">
                                                <label for="label-1" class="form-label">비밀번호 <span class="required">*</span></label>
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="영문+숫자+특수기호, 8자리 이상 입력.">
                                                <input type="hidden" name="password_verified" class="d-none">
                                                {{-- <small class="form-text text-muted">Password length must be atleast 8 chars.</small> --}}
                                                <span class="invalid-feedback"></span>
                                                <i class="ti ti-eye-off pass-toggle" style="cursor: pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 passwod-eye">
                                                <label for="label-1" class="form-label">비밀번호 확인 <span class="required">*</span></label>
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    placeholder="비밀번호를 확인해 주세요.">
                                                <span class="invalid-feedback"></span>
                                                <i class="ti ti-eye-off pass-toggle" style="cursor: pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="label-1" class="form-label">휴대전화 <span class="required">*</span></label>
                                                <input type="text" name="phone" id="nice_auth_mobile_no"
                                                    class="form-control {{ setting('nice_authentication', 1) ? 'disabled' : '' }}"
                                                    {{ setting('nice_authentication', 1) ? 'readonly' : '' }}
                                                    placeholder="-없이 작성해 주세요.">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="label-1" class="form-label">주소 <span class="required">*</span></label>
                                                <button type="button" id="daum-address"
                                                    class="btn btn-primary-btn w-100 mb-3" onclick=" findPostalCode()">주소
                                                    검색</button>
                                                <div class="address-fields">
                                                    <input type="text" readonly name="post_code"
                                                        class="form-control mb-2" id="post_code">
                                                    <input type="text" readonly name="address"
                                                        class="form-control mb-2" id="address">
                                                    <input type="text" name="address_detail" class="form-control mb-2"
                                                        placeholder="상세주소를 작성해 주세요." id="address_detail">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row referral-code">
                                        <label class="col-sm-12 form-label">추천인 코드</label>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-xs-12 input-container">
                                            <input type="text" id="referral_code" name="referral_code"
                                                class="form-control" placeholder="추천인 코드를 작성해 주세요.">
                                            <input type="hidden" name="referral_code_verified">
                                            <span id="referral_code_error" class="invalid-feedback"></span>
                                        </div>
                                        <div class="col-xs-12 col-md-4 col-xl-2 col-lg-4 btn-container">
                                            <button type="button" class="btn btn-primary-btn mt-space" id="ref-validate">이름 확인</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <label for="label-1" class="form-label">신분증 (수당 지급용) (선택)</label>
                                                <div class="row">
                                                    <div class="col-3 col-md-2 col-lg-2 col-xl-1 ">
                                                        <div>
                                                            <img class="img-preview" id="id_photo-preview"
                                                                src="{{ asset('images/no-image.png') }}" alt="no-image" />
                                                        </div>
                                                    </div>
                                                    <div class="col-9 col-md-10 col-lg-10 col-xl-11 pl-mb">
                                                        <div class="d-flex card-id-img">
                                                            <div>

                                                                <label class="form-control" onclick="$('#id_photo').click();"
                                                                    style="margin-left: 15px;">신분증을
                                                                    업로드해 주세요.</label>
                                                                <input id="id_photo" type="file" name="id_photo"
                                                                    accept="image/*" style="visibility:hidden;" class="d-none">
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                            <button class="btn btn-sm browse-btn btn-purple-color mt-space"
                                                                type="button" onclick="$('#id_photo').click();">파일찾기
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <label for="label-1" class="form-label">통장 앞면 (수당 지급용) (선택)</label>
                                                <div class="row">
                                                    <div class="col-3 col-md-2 col-lg-2 col-xl-1 ">
                                                        <div>
                                                            <img class="img-preview" id="bankbook_photo-preview"
                                                                src="{{ asset('images/no-image.png') }}" alt="no-image" />
                                                        </div>
                                                    </div>
                                                    <div class="col-9 col-md-10 col-lg-10 col-xl-11 pl-mb">
                                                        <div class="d-flex card-id-img">
                                                            <div>
                                                                <label class="form-control" onclick="$('#bankbook_photo').click();"
                                                                    style="margin-left: 15px;">신분증을 업로드해 주세요.</label>
                                                                <input id="bankbook_photo" type="file" name="bankbook_photo"
                                                                    accept="image/*" style="visibility:hidden;" class="d-none">
                                                                <span class="invalid-feedback"></span>
                                                            </div>
                                                            <button class="btn btn-sm browse-btn btn-purple-color mt-space"
                                                                type="button" onclick="$('#bankbook_photo').click();">파일찾기
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="label-1" class="form-label">수당 계좌 번호 (선택)</label>
                                                <select id="bank_name" class="form-select" name="bank_name">
                                                    <option value="">은행선택</option>
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank->id }}">{{ $bank->display_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="label-1" class="form-label">계좌번호 (선택)</label>
                                                <input id="account_number" type="text" name="account_number"
                                                    class="form-control" placeholder="-없이 작성해 주세요.">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="nice_auth_date_of_birth" value="{{ date('Y-m-d') }}"
                                        name="date_of_birth">
                                    <input type="hidden" name="member_id">
                                    <input type="hidden" id="nice_auth_gender" name="gender">
                                    <div class="row">
                                        <div class="d-flex justify-content-start">
                                            <div class="d-grid gap-2 col-12 mt-3 h-75 mb-3">
                                                <button type="button" id="next-2" disabled
                                                    class="btn btn-primary-btn w-100 next-thank-page">다음</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                        <!------------------------------------------------------------------------- member-info Section  End ---------------------------------------------------------------->
                        <section id="thankyou-info" class="registration-section">
                            <div class="form-container text-center">
                                <h5 class="page_title mb-5">
                                    수고많으셨습니다.
                                </h5>

                                <i class="ti ti-check"></i>
                                <p>본사 검토 후, 최종 등록이 완료되면 중요 정보를 문자로 발송해 드립니다.<br />
                                    (영업일 1~2일 이내)<br />
                                    <span> 회사 문자 번호( {{ setting('bh_telephone', '') }} )가 스팸처리 되지 않도록 주의해 주세요.</span>

                                <div class="d-grid gap-2 col-12 mt-3 h-75 mb-3">
                                    <button type="button" onclick="window.location.href='{{ route('login') }}'"
                                        class="btn btn-primary-btn w-100">확인</button>

                                </div>
                            </div>
                        </section>
                        @if (setting('nice_authentication', 1))
                            @php
                                $niceVerifyService->setReturnURL(route('nice-verify.success'));
                                $niceVerifyService->setErrorURL(route('nice-verify.fail'));
                            @endphp

                            {!! $niceVerifyService->initNiceForm() !!}
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Ensure this runs before any other AJAX request
            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
        });

        let nice_status = false;

        $(document).ready(function() {

            // if user comes with a ref code in the URL, add that into the referral_code input

            @if (request()->has('bhid'))
                $('#referral_code').val('{{ request()->get('bhid') }}');
            @endif


            $('.passwod-eye i').on('click', function(event) {
                let main = $(event.currentTarget).closest('.passwod-eye')
                let inp = $(event.currentTarget).closest('.passwod-eye').find('input');
                if (inp.prop('type') === 'password') {
                    inp.prop('type', 'text');
                    main.find('i').removeClass('ti-eye-off');
                    main.find('i').addClass('ti-eye');
                    return
                }
                inp.prop('type', 'password');
                main.find('i').removeClass('ti-eye');
                main.find('i').addClass('ti-eye-off');
            });


            $('#mobile-auth').on('click', function() {
                nicePhoneVerify();
            });

            // check seesion has value
            var isDataSet = "<?php echo isset($data['data']) ? 'true' : 'false'; ?>";

            function toggleSubmitButton() {
                if (isDataSet === 'false') {
                    $('.next-page').prop('disabled', true);
                    $('#mobile-auth').prop('disabled', false);
                    $('#checkout-payment').prop('disabled', true);
                } else {
                    $('.next-page').prop('disabled', false);
                    $('#mobile-auth').prop('disabled', true);
                    $('#checkout-payment').prop('disabled', false);

                }
            }
            toggleSubmitButton();

        });

        function nicePhoneVerifyCallback(args) {
            let {
                name,
                gender,
                mobile_no,
                birthdate
            } = args
            if (name != '') {
                // jQuery('#btn_auth').val('인증완료')
                $('#mobile-auth').attr('disabled', true);
                $('.next-page').prop('disabled', false);
                $('#mobile-auth').prop('disabled', true);
                $('#checkout-payment').prop('disabled', false);
                verify_phone(mobile_no,function(res){
                    if (res.success) {
                        Swal.fire({
                            text: "이미 가입된 회원입니다",
                            icon: "info",
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: 'check-button'
                            }
                        }).then((result) => {
                            window.location.reload();
                        });
                    }
                })
                $('#nice_auth_name').val(name);
                $('#nice_auth_mobile_no').val(mobile_no);
                $('#nice_auth_date_of_birth').val(birthdate);
                $('#nice_auth_gender').val(gender);
                nice_status = true
                // nice_window.close();
                $('.shade-orange.btn.mt-5.next-page').click();
            } else {
                Swal.fire({
                    title: "인증성공!",
                    text: "본인인증에 실패하였습니다.",
                    icon: "error",
                });
            }

        }

        function verify_phone(number,callback) {
            let url = "{{ route('verify-phone') }}";
            let _token = "{{ csrf_token() }}";
            let formData = new FormData();
                formData.append("phone_number",  number);
                formData.append("_token",  _token);
            $.ajax({
                type: "POST",
                url: url,
                data: formData, // Send serialized form data
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (typeof callback === 'function') {
                        callback(response);
                    }
                }
            });

        }
    </script>

    <script src="{{ asset('vendor/step-registration/step-registration.js') }}"></script>
    <script src="{{ asset('vendor/daum-api/daum.api.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#step-2-form').validate({
                ignore: [],
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    email_available: {
                        equalTo: '[name="email"]'
                    },
                    name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        // digits: true,
                    },
                    password: {
                        required: true,
                        // minlength: 8,
                    },
                    password_verified: {
                        equalTo: '[name="password"]',
                    },
                    password_confirmation: {
                        required: true,
                        // minlength: 8,
                        equalTo: '[name="password"]',
                    },
                    post_code: {
                        required: true,
                    },
                    referral_code_verified: {
                        equalTo: '[name="referral_code"]',
                    },
                    date_of_birth: {
                        required: true,
                    },
                },
            });

            $('#step-2-form').change(function() {
                nextButtonEnableDisabled();
            });

            $('.next-page').click(function() {
                var button_text = $('#email-validate').html();
                $('#email-validate').html('<i class="fa fa-spinner fa-spin"></i>');
                setTimeout(() => {
                    $('#email-validate').html(button_text);
                }, 200);
            });

            $('#email-validate').click(function() {
                var button_text = $('#email-validate').html();
                let _token = "{{ csrf_token() }}";
                $('#error_email').hide();
                var email = $('#email').val();
                $.ajax({
                    url: "{{ route('email_available.check') }}",
                    method: "POST",
                    data: {
                        email: email,
                        _token: _token
                    },
                    beforeSend: function(xhr) {
                        $('[name="email_available"]').val('');
                        $('#email-validate').html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled', 'disalbed');
                        },
                        success: function(result) {
                            if (result == 'true') {
                            $('#email-validate').html("확인 완료");
                            $('#error_email').html('');
                            $('#email').removeClass('has-error');
                            $('[name="email_available"]').val(email);
                        } else {
                            $('#error_email').html(
                                '<label class="text-danger">Email not available</label>'
                            );
                            $('#email').addClass('has-error');
                            $('#next-2').attr('disabled', 'disabled');
                            $('#email-validate').html(button_text).attr('disabled', false);
                            $('#email-validate').html("중복 확인");
                        }
                        $('#error_email').show();
                        nextButtonEnableDisabled();
                    },
                    error: function(err) {
                        $('#email-validate').html(button_text).attr('disabled', false);
                        $('#email-validate').html("중복 확인");
                        displayErrors(err);
                    },
                    complete: function() {
                        $('#email-validate').html("확인 완료");
                    }
                })
            });

            $('#ref-validate').click(function() {
                var button_text = $('#ref-validate').html();
                let _token = "{{ csrf_token() }}";
                $('#referral_code_error').hide();
                var referral_code = $('#referral_code').val();
                
                
                $.ajax({
                    url: "{{ route('referral_code.check') }}",
                    method: "POST",
                    data: {
                        referral_code : referral_code,
                        _token : _token,
                    },
                    beforeSend: function(xhr) {
                        $('#ref-validate').html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled', 'disalbed');
                        $('[name="referral_code_verified"]').val('');
                    },
                    success: function(result) {
                        if (result == 'false') {
                            $('#referral_code_error').html(
                                '<label class="text-danger">Invalid Referral Code</label>');
                            $('#referral_code').removeClass('has-error');
                            // $('#next-2').attr('disabled', 'disabled');
                            $('#ref-validate').html(button_text).attr('disabled', false);
                        } else {
                            $('#ref-validate').html('확인 완료');
                            $('#referral_code_error').html('');
                            // $('#referral_code_error').html(
                            //     '<label class="text-success"><i class="fa fa-check"></i> Valid Referral Code</label>'
                            //     );
                            $('#referral_code').addClass('has-error');

                            // $('#next-2').attr('disabled', false);
                            $('[name="referral_code_verified"]').val(referral_code);

                            var recommender = result.recommender;
                            var first_name = recommender.first_name == null ? '' : recommender
                                .first_name;
                            var last_name = recommender.last_name == null ? '' : recommender
                                .last_name;

                            Swal.fire({
                                title: `추천인 : ${ first_name +' '+ last_name}`,
                                html: "추천인의 이름이 상이한 경우,<br>추천인 혹은 고객센터({{ setting('bh_telephone', '') }}, 평일 10:00~17:00)에 문의 바랍니다.",
                                icon: "success",
                                customClass: {
                                    confirmButton: 'btn btn-primary-btn w-100',
                                },
                                confirmButtonText: "{{ trans('user::biz-planner.check') }}",
                                buttonsStyling: false
                            });
                        }
                        $('#referral_code_error').show();
                        nextButtonEnableDisabled();
                    },
                    error: function(error) {
                        $('#ref-validate').html(button_text).attr('disabled', false);
                        displayErrors(error);
                    },
                    complete: function() {
                        $('#ref-validate').html(button_text);
                    }
                });
            });
            $('#referral_code').change(function() {
                $('#referral_code_error').hide();
                $('#ref-validate').attr('disabled', false);
                $('[name="referral_code_verified"]').val('');
            });
            $('#email').on('keyup',function() {
                $('#error_email').hide();
                $('#email-validate').attr('disabled', false);
                $('#email-validate').html("중복 확인");
            });

            /*  $('[name="phone"]').on('input',function() {
                  var rule = /^0\d{10}$/;
                  var phone = $(this).val().replace(/[^0-9]/g, '');
                  $(this).val(phone);
                  if((phone.length < 10 || phone.length > 11) || !rule.test(phone)) {
                      console.log(1);
                      $(`[name="phone"]`).siblings('.invalid-feedback').text('잘못된 전화 번호.').show();
                  } else {
                      console.log(0);
                      $(`[name="phone"]`).siblings('.invalid-feedback').text('').hide();
                  }
              })
              */

            $('[name="phone"]').on('input', function() {
                var phone = $(this).val().replace(/\D/g, '');
                $(this).val(phone);

                if (phone.length === 10 || phone.length === 11) {
                    $(`[name="phone"]`).siblings('.invalid-feedback').text('').hide();
                } else {
                    $(`[name="phone"]`).siblings('.invalid-feedback').text('잘못된 전화 번호.').show();
                }
            });


            $('input[name="password"]').blur(function() {
                const password = $('input[name="password"]').val();
                const pass_verified_field = $('input[name="password_verified"]');
                const password_confirm_field = $('input[name="password_confirmation"]');
                let _token = "{{ csrf_token() }}";
                if (!password.length) {
                    return true;
                }

                if(validatePassword(password)){
                    $('input[name="password"]').siblings('.invalid-feedback').hide();
                    pass_verified_field.val(password);
                    if (pass_verified_field.val() !=  password_confirm_field.val()) {
                        password_confirm_field.siblings('.invalid-feedback').text('비밀번호가 일치하지 않습니다.').show();
                    }else{
                        password_confirm_field.siblings('.invalid-feedback').hide();
                    }
                    nextButtonEnableDisabled();
                }else{
                    $('input[name="password"]').siblings('.invalid-feedback').text('영문,숫자,특수문자 포함 8자리 이상 입력.').show();
                }
            });
            $('input[name="password_confirmation"]').on('input change keyup paste drop', function() {
                const password_confirm_field = $('input[name="password_confirmation"]');
                if ($('input[name="password_verified"]').val() != password_confirm_field.val()) {
                    password_confirm_field.siblings('.invalid-feedback').text('비밀번호가 일치하지 않습니다.').show();
                }else{
                    password_confirm_field.siblings('.invalid-feedback').hide();
                }
            });
            function validatePassword(value) {
                // Minimum 8 characters
                if (value.length < 8) {
                    return false;
                }

                // At least 1 number
                if (!/\d/.test(value)) {
                    return false;
                }

                    // At least 1 special character
                if (!/[^A-Za-z0-9]/.test(value)) {
                    return false;
                }

                // If all conditions are met
                return true;
            }
        });

        $('#next-2').click(function() {
            var number = jQuery('#nice_auth_mobile_no').val();
            let _token = $('#step-2-form').find('input[name="_token"]').val();
            verify_phone(number, function (res) {
                    if (res.success) {
                        Swal.fire({
                            text: "이미 가입된 회원입니다",
                            icon: "info",
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: 'check-button'
                            }
                        }).then((result) => {
                            window.location.reload();
                        });
                        return;
                    } else {
                        const buttonText = $('#next-2').text();
                        if (!$('#step-2-form').valid()) {
                            return false;
                        }

                        $.ajax({
                            url: "{{ route('registration.store') }}",
                            processData: false,
                            contentType: false,
                            method: "POST",
                            data: new FormData($('#step-2-form')[0]),
                            beforeSend: function (xhr) {
                                $('#next-2').html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled', 'disabled');
                            },
                            success: function (result) {
                                $('#member-info').hide();
                                $('#thankyou-info').show();
                            },
                            error: function (err) {
                                displayErrors(err);
                            },
                            complete: function () {
                                $('#next-2').html(buttonText).attr('disabled', false);
                            }
                        });
                    }
                }
            )

        });


        function displayErrors(err) {
            const {
                status,
                responseJSON
            } = err;
            if (status == 422) {
                const {
                    errors
                } = responseJSON;
                $.each(errors, function(key, value) {
                    $(`[name="${key}"]`).siblings('.invalid-feedback').text(value[0])
                        .show();
                });
            }
        }

        function nextButtonEnableDisabled() {
            const val = $('#step-2-form').valid() ? false : 'disabled';
            $('#next-2').attr('disabled', val);
        }

        function findPostalCode() {
            // Daum API call to find postal code
            new daum.Postcode({
                oncomplete: function(data) {
                    var addr = '';
                    if (data.userSelectedType === 'R') {
                        addr = data.roadAddress;
                    } else {
                        addr = data.jibunAddress;
                    }

                    if (data.userSelectedType === 'R') {
                        if (data.bname !== '' && /[to|to|to]$/g.test(data.bname)) {
                            extraAddr += data.bname;
                        }
                    }
                    document.getElementById('post_code').value = data.zonecode;
                    document.getElementById("address").value = addr;

                    $("#post_code").css("background-color", "transparent");
                    $("#address").css("background-color", "transparent");
                    // document.getElementById("address_detail").value = data.address;
                    document.getElementById("address_detail").focus();
                    nextButtonEnableDisabled();
                }
            }).open();

        }

        $(document).ready(function() {
            $('input[type="file"]').change(function() {
                const name= $(this).attr('name');
                const file = this.files[0];
                if (file && name && $(`#${name}-preview`)) {
                    filename = file.name;
                    $(this).siblings('label').text(filename);
                    const imageUrl = URL.createObjectURL(file);
                    $(`#${name}-preview`).attr('src',imageUrl)
                }
            });
        })
    </script>
@endpush
