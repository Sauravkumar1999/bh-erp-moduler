@extends('bhub::sales.master',['title'=>'무릎 줄기 세포'])
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ themes('/css/new_responsive.css') }}" />
    {!! htmlScriptTagJsApi() !!}
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="pagename">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <p class="title2">무릎 줄기 세포 </p>
                </div>
            </div>
        </div>
    </div>
    <div class="pagetitle">
        <div class="container">
            <h2 class="title1">첨단 바이오 기술을 통해 건강한 미래를 만듭니다.</h2>
            <div id="title_bg" class="display_desktop d-none d-md-block">
                <h2 class="title2">구체적인 상담이 필요하신 분들은 아래에서 문의 주세요.</h2>
            </div>
            <div id="title_bg" class="display_mobile d-block d-md-none">
                <h2 class="title2 mb-2">구체적인 상담이 필요하신 분들은</h2>
            </div>
            <div id="title_bg" class="display_mobile d-block d-md-none">
                <h2 class="title2">아래에서 문의 주세요.</h2>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <p class="title2 mb-4">무릎 줄기 세포</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <img class="knee_stem_cell_img" src="{{ themes('/images/knee_stem_cell.png') }}" />
                </div>
                <div class="col-12 col-md-9 d-flex align-items-center">
                    <p class="knee_stem_cell_details">신체 노화가 진행되면, 무릎 연골이 점차적으로 닳아가고 줄어듭니다. 그러므로 퇴행성 관절염, 연골 손상, 관절염 질병이 생기게 됩니다. 특히 퇴행성 무릎 관절염은 65세 이상 인구 중 37.8% 정도가 걸린 질환으로 남성보다는 여성이 두 배 이상 더 높게 나타납니다. 관절염 환자 치료는 약물, 물리 치료, 인공 관절수술 등 다양한 방법이 시행되고 있으며, <span>최근 무릎 줄기 세포 치료(주사)는 보건복지부에서 공식적 의료 기술로 인정 받아 주목</span>을 받고 있습니다.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('bhub::sales.partials._session_alerts')
    <div class="knee_stem_cell_form">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <p class="title2 mb-5">무릎 줄기 세포 </p>
                </div>
            </div>
            <div class="row form-section">
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-6">
                    <form id="knee_stem_cell_form" class="knee_stem_cell_form"
                        action="{{ route('sales.knee-stem-cells.send') }}" method="POST">
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
                            <input type="text" class="form-control" id="" name="contact" required placeholder="숫자만 입력해 주세요">
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
                        <div class="form-check mt-4 condition1">
                            <input class="form-check-input" type="checkbox" id="term_service1" name="condition1">
                            <label class="form-check-label">
                                [필수] 위 개인정보 수집, 이용에 동의합니다. <span class="agreement1" style="cursor: pointer;"> [내용보기] </span>
                            </label>
                        </div>
                        <div class="form-check mb-5">
                            <input class="form-check-input" type="checkbox" id="term_service2" name="condition2">
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

                        <div class="text-center mb-5">
                            <button type="submit" id="submitBtn" class="btn knee_stem_cell_btn bhub-submit-btn" disabled>신청하기</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-3"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script>
        const term1 = document.getElementById('term_service1');
        const term2 = document.getElementById('term_service2');
        const formInputs = document.querySelectorAll(
                '.knee_stem_cell_form input');
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
            const textField = $('.knee_stem_cell_form input[type="text"], .knee_stem_cell_form select').filter(
                function() {
                    return $(this).val() === '';
                }).length > 0;
            const checkboxField = $('.knee_stem_cell_form input[type="checkbox"]').filter(function() {
                return !$(this).prop('checked');
            }).length > 0;
            if (yearSelect.value === '' || monthSelect.value === '' || daySelect.value === '' || hourSelect
                .value === '' ||
                hourSelect.value == '시간선택' || term1.checked === false || term2.checked === false) {
                isFormValid = false;
            }

            var reCaptchaInput = document.getElementById('reCaptchaValue')
            if(reCaptchaInput.getAttribute('value') == 'failed'){
                isFormValid = false;
            }

            $('#submitBtn').prop('disabled', !isFormValid);
        }
        $(document).ready(function() {
            formInputs.forEach(function(input) {
                input.addEventListener('input', validateForm);
            });
            $('.knee_stem_cell_form').on('change', 'select', function() {
                validateForm();
            });

            var data1 = "";
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> 1. 수집하는 개인정보 항목: 성명 / 전화번호 / 사업장명, 사업자 번호 (선택적) / 주소(선택적)</p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">2. 개인정보의 수집 목적</p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 1) 상품 또는 서비스 문의 요청에 대한 답변 </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 2) 상품 또는 서비스에 대한 주문 처리 및 배송 정보 제공 </p></b> <br>'
                data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;"> &nbsp;&nbsp; 3) 상품 또는 서비스 이용에 관한 통계, 분석, 개인화 서비스 제공 </p></b><br>'
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
    <script>
        function renderTime(year, month, day) {
            var selectedDate = year + '-' + month.padStart(2, '0') + '-' + day.padStart(2, '0');

            var today = new Date().toISOString().split('T')[0];
            var timeDropdown = $('#available_call_hour');
            timeDropdown.empty();

            if (selectedDate === today) {
                timeDropdown.append($('<option>', {
                    value: null,
                    text: '시간선택'
                }));

                appendOptions(timeDropdown);
                disableMonthAndDay();
                $('#available_call_hour').removeAttr('disabled');
                $('#available_call_hour option').each(function() {
                    var formTime = convertTo24Hour($(this).val());
                    if (formTime !== null) {
                        if (formTime < '{{ (intval(date('H')) + 3) % 24 }}') {
                            $(this).prop('disabled', true);
                        }
                    }
                });
            } else {
                // if the year is the same but not today
                if (year != '{{ date('Y') }}') {
                    $('#available_call_month').find('option').prop('disabled', false);
                    $('#available_call_day').find('option').prop('disabled', false);
                } else {
                    disableMonthAndDay();
                }
                appendOptions(timeDropdown);
            }
        }

        function convertTo24Hour(input) {
            if (input !== "시간선택") {
                var timeSplit = input.split(':');
                var hours = parseInt(timeSplit[0]);
                var minutes = parseInt(timeSplit[1].split(' ')[0]);
                var meridian = timeSplit[1].split(' ')[1];

                // Adjust hours based on meridian
                if (meridian === "PM" && hours < 12) {
                    hours += 12;
                } else if (meridian === "AM" && hours === 12) {
                    hours = 0;
                }

                // Return time in 24-hour hours
                return hours;
            }

            return null;
        }

        function disableMonthAndDay() {
            $('#available_call_month option').each(function() {
                if ($(this).val() < '{{ date('m') }}') {
                    $(this).prop('disabled', true);
                }
            });
            $('#available_call_day option').each(function() {
                if ($(this).val() < '{{ date('d') }}') {
                    $(this).prop('disabled', true);
                }
            });
        }

        function appendOptions(timeDropdown) {
            for (var time = 540; time <= 1080; time += 60) {
                var hours = Math.floor(time / 60);
                var minutes = time % 60;
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // Handle midnight (0 hours)
                var formattedTime = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' :
                    '') + minutes + ' ' + ampm;
                timeDropdown.append($('<option>', {
                    value: formattedTime,
                    text: formattedTime
                }));
            }

        }
    </script>
@endsection