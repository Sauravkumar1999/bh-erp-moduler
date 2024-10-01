@extends('layouts.master', ['inquiry_form_link' => 'inquiry-form'])

@section('title', '가맹 절차 | Business Hub')

@section('css')
    <link rel="stylesheet" href="{{ themes('css/merchant.css') }}">
    <style>
        #inquiry-form-container .form-group .form-check label span {
            color: #EC661A;
        }
        .swal2-popup .swal2-title{
            font-size: 1.4em !important;
       }
    </style>
    {!! htmlScriptTagJsApi() !!}
@stop

@section('content')
    <div class="container">
        <div class="upper-money-cards mt-5 pt-5">
            <div class="main-card-container">
                <div class="text-above-cards d-none">
                    <h2>가맹 절차</h2>
                </div>
                <div class="picture-card">
                    <img class="d-none d-md-block" src="{{ themes('images/merchant.png') }}" alt="merchant_procedure">
                    <img class="d-block d-md-none" src="{{ themes('images/merchant-mobile.png') }}"
                        alt="merchant_procedure">
                </div>
            </div>

        </div>
        <div class="below-card-content">
            <div>
                <h2>기타사항</h2>
                <div class="below-card-content-container">
                    <ul>
                        <li>PG사 (KSNET) 정식 심사 단계는 가맹주가 48 Mall 온라인 가입 후, 통상 10~15일 소요되며, 중간 보완 요청 혹은 PG사(KSNET) 사정에
                            따라 많은 차이가 있을 수 있습니다.</li>
                        <li>기타 과정의 소요 시간은 온라인 입력 과정이므로 단시간에 진행이 가능합니다.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="franchise-consultation">
            <div class="container-fluid">
                <div class="franchise-consultation-container">
                    <h4>현재 온/오프라인기업체,자영업,서비스업,병원등 많은 곳에서 이미 48 Pay 가맹을하셨습니다</h4>
                    <h3>먼저, 가맹상담을 받아보세요</h3>
                </div>

                <div class="text-above-cards" id="inquiry-form">
                    <h2><img src="{{ themes('images/dart.svg') }}" alt=""> 가맹 상담 신청</h2>
                </div>


                <div class="container">
                    <form class="form-container" id="inquiry-form-container" action="{{ route('48-pay.inquiry.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="company_name">회사명 <img src="{{ themes('images/required.svg') }}" alt=""></label>
                            <input type="text" class="form-control" id="company_name" value="{{ old('company_name') }}" name="company_name" required>
                            @error('company_name')
                                    <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_registration_number">사업자 등록번호 <img src="{{ themes('images/required.svg') }}" alt=""></label>
                            <input type="text" class="form-control" id="company_registration_number"
                                placeholder="숫자만 입력해 주세요" value="{{ old('company_registration_number') }}" name="company_registration_number" required>

                            @error('company_registration_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_person_name_position">담당자 성명 / 직책 <img src="{{ themes('images/required.svg') }}" alt=""></label>
                            <input type="text" class="form-control" id="contact_person_name_position"
                                placeholder="숫자만 입력해 주세요" value="{{ old('contact_person_name_position') }}" name="contact_person_name_position" required>

                            @error('contact_person_name_position')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_email">담당자 Email <img src="{{ themes('images/required.svg') }}" alt=""></label>
                            <input type="email" class="form-control" id="contact_email" value="{{ old('contact_email') }}" name="contact_email" required>
                            @error('contact_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact_phone_number">담당자 전화번호 <img src="{{ themes('images/required.svg') }}" alt=""></label>
                            <input type="tel" class="form-control" id="contact_phone_number" placeholder="숫자만 입력해 주세요" value="{{ old('contact_phone_number') }}" name="contact_phone_number" required>
                            @error('contact_phone_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inquiry">문의사항</label>
                            <textarea class="form-control" id="inquiry" name="inquiry" rows="3" placeholder="내용을 입력해 주세요">{{ old('inquiry') }}</textarea>
                        </div>

                        <div class="form-group checkbox-container">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="terms_and_service1" name="terms_and_service1">
                                <label class="form-check-label agreement-label" for="terms_and_service1"><p>[필수] 위 개인정보 수집, 이용에 동의합니다. <span class="colored agreement1" style="cursor: pointer;"> [내용보기] </span></p></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="terms_and_service2" name="terms_and_service2">
                                <label class="form-check-label agreement-label" for="terms_and_service2"><p>[필수] 위 개인정보 제3자 제공에 동의합니다. <span class="colored agreement2" style="cursor: pointer;"> [내용보기] </span></p></label>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            {!! htmlFormSnippet() !!}
                        </div>

                        <div class="form-group">
                            <button id="submitBtn" type="submit" class="btn btn-sm btn-outline" disabled>신청하기</button>
                        </div>

                    </form>
                </div>

                <div class="affiliate-assistant">
                    <div class="text-above-cards">
                        <h2>가맹 도우미</h2>
                    </div>
                    <div class="button-container">
                        <div class="button-group1">
                            <a target="_blank" href="http://www.48mall.co.kr/" class="btn">48 Mall 회원 등록하기</a>
                            <a target="_blank" href="http://partner.48mall.co.kr/" class="btn">파트너 입점 입력하기</a>
                            <button onclick="downloadFile('48pay_online.pdf')" class="btn">48 Pay 온라인 입력 이렇게 하세요</button>
                        </div>

                        <div class="button-group2">
                            <button onclick="downloadFile('48pay_form.pdf')" class="btn">48 Pay 서류 양식 다운받기</button>
                            <button onclick="downloadFile('48pay_guide.zip')" class="btn">48 Pay 서류 작성 이렇게 하세요</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

        const formInputs = document.querySelectorAll('#inquiry-form-container input:not([type="checkbox"])');
        formInputs.forEach(function(input) {
            input.addEventListener('input', validateForm);
        });

        const formCheck = document.querySelectorAll('#inquiry-form-container input[type="checkbox"]');
        formCheck.forEach(function(input) {
            input.addEventListener('change', validateForm);
        });

        function validateForm() {
            let isFormValid = true;
            formInputs.forEach(function(input) {
                if (input.required && input.value.trim() === '') {
                    isFormValid = false;
                }
            });

            const submitBtn = document.getElementById('submitBtn');

            const term1 = document.getElementById('terms_and_service1');
            const term2 = document.getElementById('terms_and_service2');

            if (term1.checked === false || term2.checked === false) {
                isFormValid = false;
            }

            if (isFormValid) {
                submitBtn.removeAttribute('disabled');
            } else {
                submitBtn.setAttribute('disabled', 'disabled');
            }
        }

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
            data1 = data1 + '<b><p align="left" style="font-size: 14px;color:#000;">5. 동의철회 및 개인정보 열람/정정/삭제 요청 방법: 본사 {{ setting('bh_telephone', ''); }} 전화, 본인 확인 후 처리 </p></b>'

        $(document).ready(function() {       
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
