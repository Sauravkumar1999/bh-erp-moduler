@extends('bhub::sales.master',['title'=>'Skeeper'])
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
     {!! htmlScriptTagJsApi() !!}
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="skeeper_cvr_banner">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <p class="title1">비대면 스마트 청진기 (Skeeper)</p>
                </div>
                <div class="col-md-6 text-center text-md-center">
                    <img class="banner_img1" src="{{ themes('/images/skeeper_bnr_img-removebg-preview.png') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4"></div>
                <div class="col-12 col-md-4 sr_ul">
                    <img src="{{ themes('/images/skeeper_img.png') }}">

                    <ul class="mt-5" style="padding-left: 4rem !important;">
                        <li class="knee_stem_cell_details">FDA 승인 획득</li>
                        <li class="knee_stem_cell_details">심장 전문의 검증 및 호평</li>
                        <li class="knee_stem_cell_details">세계에서 인정받은 최고 기술력</li>
                    </ul>
                </div>
                <div class="col-12 col-md-4"></div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <img class="d-none d-md-block" src="{{ themes('/images/skeeper_frame.png')}}">
                     <img class="d-block d-md-none" src="{{ themes('/images/mobile_skeeper_img.png') }}">
                </div>
                <div class="col-12 mt-5 pt-0 pt-md-5">
                    <img class="d-none d-md-block" src="{{ themes('/images/skeeper_img_details.png')}}">
                </div>
            </div>
        </div>
    </div>
    <img class="d-block d-md-none" src="{{ themes('/images/skeeper1.png')}}" width="100%">
    <div class="pagetitle mt-5">
        <img class="d-block d-md-none" src="{{ themes('/images/skeeper2.png')}}">
        <img class="d-block d-md-none mt-5" src="{{ themes('/images/skeeper3.png')}}">
    </div>

    <div class="knee_stem_cell_form mb-5 pb-5">
        <div class="container">
            <div class="safety_cvr_form">
                <div class="row text-center">
                    <div class="col-12">
                        <p class="title2 mb-5">상담 신청</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3"></div>
                    <div class="col-12 col-md-6">
                        <form id="knee_stem_cell_form" class="skeeper_form"
                            action="{{ route('sales.skeeper.send') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>성명<span>*</span></label>
                                <input type="text" class="form-control" id="" name="user_name" required>
                                @error('user_name')
                                    <div class="text-danger">{{ $user_name }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label>연락처<span>*</span></label>
                                <input type="text" class="form-control" placeholder="숫자만 입력해 주세요" id="" name="contact" required>
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
                            {{-- <div class="form-group mb-3">


                                @error('consulting')
                                    <div class="text-danger">{{ $consulting }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-check mt-4 condition1">
                                <input class="form-check-input" type="checkbox" id="term_service1" name="terms_and_service1">
                                <label class="form-check-label">
                                    [필수] 위 개인정보 수집, 이용에 동의합니다. <span class="agreement1" style="cursor: pointer;"> [내용보기] </span>
                                </label>
                            </div>
                            <div class="form-check mb-5">
                                <input class="form-check-input" type="checkbox" id="term_service2" name="terms_and_service2">
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
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="hidden" id="reCaptchaValue" value="failed">

                            @include('bhub::sales.partials._bhid-hidden-input')

                            <div class="text-center">
                                <button type="submit" id="submitBtn" class="btn knee_stem_cell_btn bhub-submit-btn"
                                    disabled>신청하기</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3">

                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="button" onclick="downloadFile('skeeper.pdf')" class="btn text-center skeeper_btn_end">스마트 청진기 안내 자료 (PDF) 다운받기</button>
        </div>
    </div>
    @php
        $currentTime = strtotime('+3 hours');
    @endphp
@endsection
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script>
        function downloadFile(filename) {
            // just change the route for the download
             let url = "{{ route('media.s3-objects.download', ':file') }}";

             url = url.replace(':file', filename);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data, status, xhr) {
                    // File download initiated successfully
                    console.log('File download initiated successfully');
                    var blob = new Blob([data], {
                        type: xhr.getResponseHeader('Content-Type')
                    });

                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);

                    link.download = filename;
                    link.target = '_blank';

                    document.body.appendChild(link);

                    link.click();

                    document.body.removeChild(link);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error downloading file:', error);
                }
            });
        }

        const term1 = document.getElementById('term_service1');
        const term2 = document.getElementById('term_service2');
        const formInputs = document.querySelectorAll(
            '.skeeper_form input[type="text"], .skeeper_form textarea');
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
            // var fields = $('input[name=consulting]:checked').length
            if (yearSelect.value === '' || monthSelect.value === '' || daySelect.value === '' || hourSelect
                .value === '' ||
                hourSelect.value == '시간선택' || term1.checked === false || term2.checked === false ) {
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
            const formInputs = document.querySelectorAll(
                '.skeeper_form input[type="text"], .skeeper_form textarea');
            formInputs.forEach(function(input) {
                input.addEventListener('input', validateForm);
            });
            $('.skeeper_form').on('change', 'input[type="checkbox"]', function() {
                validateForm();
            });
            $('.skeeper_form').on('change', 'select', function() {
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