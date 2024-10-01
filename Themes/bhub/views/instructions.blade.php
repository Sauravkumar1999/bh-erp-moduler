@extends('layouts.landing-layout', ['title' => '이용 안내 및 문의 > 고객센터'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/monthlynews.css') }}">
    <link rel="stylesheet" href="{{ themes('css/instructions.css') }}">
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "고객센터 &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;이용 안내 및 문의"])
    @include('layouts.landing-customer-center-dropdown-tabs')
    @include('bhub::sales.partials._session_alerts')

    <div class="instructions-container">
        <div class="heading">
            <h3><b>이용 안내 및 문의</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
            <div class="inst-content1">
                <h5><b>이용안내</b></h5>
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 본 홈페이지는 My HUB의 본사인 비즈니스허브 홈페이지 입니다.</h6>
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 영업자 (지사대표)를 위한 플랫폼은 “My HUB (앱)”을 별도 설치하여 사용해야 합니다.
                </h6>
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 플랫폼 연간 사용료를 납부하는 경우 더 높은 수수료와 멤버십 혜택을 받게 됩니다.
                </h6>
            </div>
            <div class="inst-content2">
                <h5><b>문의</b></h5>
                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; <b>(직통) {{ setting('bh_telephone', '') }},</b> ARS가 아니기 때문에 빠르고 편리하게 문의가
                    가능합니다.</h6>

                <h6><img src="{{ themes('images/points.png') }}"> &nbsp; 아래 문의하기를 작성해 주시면, 신속한 상담을 도와 드립니다.</h6>
            </div>
            <div class="instruction-form">

                <div class="main-form">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>Success! </strong> {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                document.querySelector('.alert').remove()
                            }, 4000);
                        </script>
                    @endif
                    @if (session('failed'))
                        <div class="alert alert-danger" role="alert">
                            <strong>Error! </strong> {{ session('failed') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                document.querySelector('.alert').remove()
                            }, 4000);
                        </script>
                    @endif
                    <form action="{{ route('instructions.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">성명<b>*</b></label>
                            <input type="text" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">핸드폰<b>*</b></label>
                            <input type="phone" id="phone_number" name="phone" required>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">이메일<b>*</b></label>
                            <input type="email" id="email" name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inquiry">문의내용<b>*</b></label>
                            <textarea id="inquiry" name="inquiry" rows="4" required></textarea>
                            @error('inquiry')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="checkbox-container">
                                <input type="checkbox" id="essential" name="term" class="checkbox-input">
                                <label class="checkbox-label">개인정보 수집 및 이용에 동의합니다. <b
                                        class="clickableAlert">상세보기</b></label>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                        </div>
                        <button type="submit" class="btn btn-outline-secondary" id="submitBtn" disabled>제출하기</button>
                    </form>
                </div>

            </div>
        </div>
    @endsection

@push('scripts')
    <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.clickableAlert');
            items.forEach(function(item) {
                item.style.cursor = 'pointer';
                item.addEventListener('click', showAlert);
            });

            const formInputs = document.querySelectorAll('.main-form input, .main-form textarea');
            formInputs.forEach(function(input) {
                input.addEventListener('input', validateForm);
            });

            const checkbox = document.getElementById('essential');
            checkbox.addEventListener('change', validateForm);

            function showAlert() {
                Swal.fire({
                    html: `<div style="text-align: left">
                   <p> ㈜비즈니스허브는 개인정보 보호법에 따라 본인의 동의를 얻어 서비스 제공을 위한 개인정보를 수집, 이용합니다.</p>
                   1. 개인정보 수집 목적 및 항목</br>
                   - 고객 문의에 대한 적절한 응답</br>
                   - 성명, 핸드폰 번호, 이메일, 문의내용</br>
                   2. 보유 및 이용 기간: 제출 후 1 년(이 후 즉시 파기)
                   </div></br>`,
                    icon: "info"
                });
            }

            function validateForm() {
                let isFormValid = true;
                formInputs.forEach(function(input) {
                    if (input.required && input.value.trim() === '') {
                        isFormValid = false;
                    }
                });

                const submitBtn = document.getElementById('submitBtn');
                if (checkbox.checked && isFormValid) {
                    submitBtn.removeAttribute('disabled');
                } else {
                    submitBtn.setAttribute('disabled', 'disabled');
                }
            }
        });
    </script>
    @endpush
