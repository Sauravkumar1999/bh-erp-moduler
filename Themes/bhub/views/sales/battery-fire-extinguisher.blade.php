@extends('bhub::sales.master',['title'=>'국내 유일, 비전도성 강화액 A,C급 소화기'])

@section('css')
    <link rel="stylesheet" href="{{ themes('css/battery-fire.css') }}">
    {!! htmlScriptTagJsApi() !!}
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="biotech__header">
        <h1>국내 유일, 비전도성 강화액 A,C급 소화기</h1>
    </div>
    <div class="biotech__container">
        <div class="biotech__content__section">
            <div class="biotech__section__header">
                <h2>
                    전기차, 충전기, 리튬이온 배터리 화재 적응성<br />
                    -엔클리어04 소화기 / 엔클리어20 소화장치-
                </h2>
                <span>국내 최초 C급(전기화재) 형식 승인서 및 검사필증완료.</span>
            </div>
            <div class="image__list__section">
                <div class="image__section">
                    <img src="{{ themes('images/battery-fire/sylendor.png') }}" />
                </div>
                <div class="image__list">
                    <ul>
                        <li>
                            <img src="{{ themes('images/battery-fire/s-1.png') }}" />
                            비전도성 A,C급 수계소화기 형식승인 완료
                        </li>
                        <li>
                            <img src="{{ themes('images/battery-fire/s-2.png') }}" />물 대비 냉각성능, 철투력, 표면장력 우수
                        </li>
                        <li>
                            <img src="{{ themes('images/battery-fire/s-3.png') }}" />인체 무독성, 영하 20도까지 얼지 않음
                        </li>
                        <li>
                            <img src="{{ themes('images/battery-fire/s-4.png') }}" />비전도성으로 전기, 전자 설비 피해 최소화
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="section__bg__color">
        <div class="biotech__container">
            <div class="video__box__container">
                <div class="video__box__item">
                    <img src="{{ themes('images/battery-fire/v-1.png') }}" />
                </div>
                <div class="video__box__item">
                    <img src="{{ themes('images/battery-fire/v-2.png') }}" />
                </div>
                <div class="video__box__item">
                    <img src="{{ themes('images/battery-fire/v-3.png') }}" />
                </div>
                <div class="video__box__item">
                    <img src="{{ themes('images/battery-fire/v-4.png') }}" />
                </div>
            </div>
        </div>
    </section>
    <section class="logo__sections">
        <h4>주요 납품 사례</h4>
        <div class="logo__wrapper">
            <img src="{{ themes('images/battery-fire/b-1.png') }}" />
            <img src="{{ themes('images/battery-fire/b-2.png') }}" />
            <img src="{{ themes('images/battery-fire/b-3.png') }}" />
            <img src="{{ themes('images/battery-fire/b-4.png') }}" />
            <img src="{{ themes('images/battery-fire/b-5.png') }}" />
        </div>
    </section>
    <section class="pt-5">
        <div class="container container-lg form-container biotech__form__container">
            <div class="d-flex align-items-center justify-content-center biotech__inner__section">
                <form class="align-items-center rental-form battry-fire"
                    action="{{ route('sales.battery-fire-extinguisher.send') }}" method="POST">
                    @csrf
                    <h4 class="fw-bold text-center title2" style="color: #ec661a;">상담 신청</h4>
                    <div class="row mt-5">
                        <div class=" col-md-12 col-sm-12 mt-3">
                            <div class="form__group">
                                <label>성명<sup>*</sup></label>
                                <input type="text" required name="name" placeholder="" />
                            </div>
                        </div>

                        <div class=" col-md-12 col-sm-12">
                            <div class="form__group">
                                <label>연락처<sup>*</sup></label>
                                <input type="text" name="contact" required placeholder="숫자만 입력해 주세요" />
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
                        <div class="col-md-12 col-sm-12 mt-4 checkbox-section">
                            <label class="form__inline-checkbox">
                                <input type="checkbox" name="terms_1" id="term_service1" />
                                [필수] 위 개인정보 수집, 이용에 동의합니다. 
                            </label>
                            <span class="colored agreement1" style="cursor: pointer;"> [내용보기] </span>
                        </div>
                        <div class="col-md-12 col-sm-12 checkbox-section">
                            <label class="form__inline-checkbox">
                                <input type="checkbox" name="terms_2" id="term_service2" />
                                [필수] 위 개인정보 제3자 제공에 동의합니다. 
                            </label>
                            <span class="colored agreement2" style="cursor: pointer;"> [내용보기] </span>
                        </div>
                        <div class="col-md-12 col-sm-12" style="display: flex">
                            {{-- <div class="form-group mt-3 mb-4">
                                {!! htmlFormSnippet() !!}
                            </div> --}}

                            <div class="form-group mt-3 mb-4">
                                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback="onRecaptchaSuccess" data-expired-callback="onRecaptchaExpired"></div>
                            </div>
                            <input type="hidden" id="reCaptchaValue" value="failed">
                        </div>
                        @error('g-recaptcha-response')
                            <div class="text-danger mb-1" style="clear: both">{{ $message }}</div>
                        @enderror
                        @include('bhub::sales.partials._bhid-hidden-input')
                        <div class="col-md-12 col-sm-12 col-lg-12 text-center">
                            <button id="submitBtn" type="submit" disabled
                                class="btn btn-color form__submit__btn bhub-submit-btn">신청하기</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        const submitBtn = document.getElementById('submitBtn');
        const term1 = document.getElementById('term_service1');
        const term2 = document.getElementById('term_service2');
        const formInputs = document.querySelectorAll(
                '.battry-fire input');

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
            $('.battry-fire').on('change', 'select', function() {
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
    <script>
        $(document).ready(function() {
            // function validateForm() {
            //     var isValid = true;
            //     $('.rental-form input[type="text"], .rental-form select').each(function() {
            //         if ($(this).val() === '') {
            //             isValid = false;
            //             return false;
            //         }
            //     });
            //     $('.rental-form input[type="checkbox"]').each(function() {
            //         if (!$(this).prop('checked')) {
            //             isValid = false;
            //             return false;
            //         }
            //     });
            //     $('#submit').prop('disabled', !isValid);
            // }
            // $('.rental-form input[type="text"], .rental-form select').change(validateForm);
            // validateForm();
        });
    </script>
@endsection