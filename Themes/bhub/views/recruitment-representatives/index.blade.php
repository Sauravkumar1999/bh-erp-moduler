@extends('layouts.landing-layout', ['title' => ' 지사대표 모집'])
@push('css')
    <style>
        .footer-container {
            /* display: none; */
        }
    </style>
    <link rel="stylesheet" href="{{ themes('css/recruitment.css') }}">
    <link rel="stylesheet" href="{{ themes('css/consultation.css') }}">
    {!! htmlScriptTagJsApi() !!}
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => '지사대표 모집'])
    @include('bhub::sales.partials._session_alerts')
    <div class="recruitment-container">
        <div class="heading">
            <h3><b>지사대표 모집</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
        </div>
        <div class="main-form">
            <form class="recruitment-rep-form" action="{{ route('recruitment-representatives.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="category">모집구분<b>*</b></label>
                    <select id="category" name="category" required>
                        <option value="" selected disabled>선택해 주세요</option>
                        <option value="Option 1">지사대표 (BP) 모집</option>
                        <option value="Option 2">본부대표 (MD) 모집</option>
                        <option value="Option 3">B2B 제휴사 모집</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">성명<b>*</b></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="contact">연락처<b>*</b></label>
                    <input type="number" id="contact" name="contact" placeholder="숫자만 입력해 주세요" required>
                </div>
                <div class="form-group">
                    <label for="contact_email">이메일<b>*</b></label>
                    <input type="email" id="contact_email" name="contact_email" required>
                </div>
                <div class="form-group">
                    <label for="inquiry">내용<b>*</b></label>
                    <textarea id="inquiry" name="inquiry" rows="4" placeholder="내용을 입력해 주세요" required></textarea>
                </div>
                <div class="form-group">
                    {!! htmlFormSnippet() !!}
                </div>
                <div class="form-group">
                    <label class="checkbox-container">
                        <label for="essential" class="checkbox-label">개인정보 수집 및 이용에 동의합니다. <b>(상세보기)</b></label>
                        <input type="checkbox" id="essential" name="term" class="checkbox-input">
                        <span class="checkmark"></span>
                    </label>
                    <div class="end-line-text">
                        <label for="third-parties" class="checkbox-label">※ 제출 후 영업일 1~3일 이내 피드백 드립니다.</label>
                    </div>
                </div>
                <div class="submit-container">
                    <button id="submitBtn" type="submit" class="btn btn-primary" value="Submit" disabled><b>제출하기</b></button>
                </div>
            </form>
        </div>

    </div>
    @push('scripts')
        <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            const term = document.getElementById('essential');

            document.getElementById('category').addEventListener('change', function() {
                var options = this.options;
                for (var i = 0; i < options.length; i++) {
                    if (options[i].selected) {
                        options[i].classList.add('selected');
                    } else {
                        options[i].classList.remove('selected');
                    }
                }
            });

            $(document).ready(function() {
                const formInputs = document.querySelectorAll(
                    '.recruitment-rep-form input');
                formInputs.forEach(function(input) {
                    input.addEventListener('input', validateForm);
                });

                const textArea = document.getElementById('inquiry');

                textArea.addEventListener("change", validateForm);

                $('.recruitment-rep-form').on('change', 'select', function() {
                    validateForm();
                });

                function validateForm() {
                    let isFormValid = true;
                    formInputs.forEach(function(input) {
                        if (input.required && input.value.trim() === '') {
                            isFormValid = false;
                        }
                    });

                    if (term.checked === false) {
                        isFormValid = false;
                    }

                    if(textArea.required && textArea.value.trim() === '') {
                        isFormValid = false;
                    }

                    $('#submitBtn').prop('disabled', !isFormValid);
                }
            });

        </script>
    @endpush
@endsection
