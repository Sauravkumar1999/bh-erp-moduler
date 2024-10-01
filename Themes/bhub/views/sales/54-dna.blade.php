@extends('bhub::sales.master',['title'=>'54DNA'])

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ themes('css/54dna.css') }}">
@endsection
@section('content')
    @include('bhub::sales.partials._nav')
    @include('bhub::sales.partials._session_alerts')
    <div class="banner">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 text-center">
                    <p class="title1">54DNA</p>
                </div>
                <div class="col-md-6 text-center mt-2">
                    <img class="banner_img1" src="{{ themes('/images/54DNA.png') }}">
                </div>
            </div>
        </div>
    </div>
    <section id="dna" class="pt-5">
        <div class="container">
            <div class="text-center">
                <h2 class="fw-bold title2 d-none d-md-block"> 카이스트 생명공학 박사 개발, 학습 유전자 검사로 <br/>나에게 맞는 현재와 미래를 설계해 보세요 </h2>
                <h2 class="fw-bold title2 d-block d-md-none"> 카이스트 생명공학 박사 개발, 학습 유전자 <br/>검사로 나에게 맞는 현재와 미래를 <br/>설계해 보세요 </h2>
                <p class="headding1 d-none d-md-block">54개 조합된 타입을 결정하는 4가지 학습유전자란?</p>
                <p class="headding1 d-block d-md-none">54개 조합된 타입을 결정하는 <br/>4가지 학습유전자란?</p>
            </div>
            <div class="row pt-2">
                <div class="col-12 col-md-3"></div>
                <div class="col-12 col-md-9">
                    <ul >
                        <li>지구력 = 체력 = 에너지 유전자 (ACE PCR)</li>
                        <li>집착 = 중독 = 표현욕구 (DRD2 PCR)</li>
                        <li>창의행동 = 호기심 = 몰입 유전 (DRD4 PCR)</li>
                        <li>감정 = 우울폭력 = 정서 유전자 (Serotonin Transporter PCR) </li>
                        <p class="mt-2">성격 형성에 영향을 주는 인성 관련 유전자를 조기에 분석하여 적성과 진로에 도움이 되도록 하는데 활용</p>
                        <li>학습 유전자(DNA) 검사는 약 8분 질문 응답을 통해 진행</li>
                        <li>54 DNA 타입의 학습 유전자 타입 검사는 9개 그룹으로 나뉘어 54개의 타입 결과를 제시</li>
                    </ul>
                </div>
            </div>
            <div class="text-center">
                <button class="dna-btn" onclick="window.location.href='https://www.54dnatype.com/questions'">54 DNA type 질문 검사하기</button>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const formInputs = document.querySelectorAll('.hanbada-form input, .hanbada-form textarea');
            formInputs.forEach(function(input) {
                input.addEventListener('input', validateForm);
            });
            $('.hanbada-form').on('change', 'input[type="checkbox"]', function() {
                validateForm();
            });

            $('.hanbada-form').on('change', 'select', function() {
                validateForm();
            });

            function validateForm() {
                let isFormValid = true;
                formInputs.forEach(function(input) {
                    if (input.required && input.value.trim() === '') {
                        isFormValid = false;
                    }
                });
                const submitBtn = document.getElementById('submitBtn');
                const yearSelect = document.getElementById('yearSelect');
                const monthSelect = document.getElementById('monthSelect');
                const daySelect = document.getElementById('daySelect');
                const hourSelect = document.getElementById('hourSelect');

                if (yearSelect.value === '' || monthSelect.value === '' || daySelect.value === '' || hourSelect
                    .value === '') {
                    isFormValid = false;
                }
                if (isFormValid) {
                    submitBtn.removeAttribute('disabled');
                } else {
                    submitBtn.setAttribute('disabled', 'disabled');
                }
            }
        });
    </script>
@endsection
