@extends('layouts.master')

@section('title', 'Merchant')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/consultation.css') }}">
    <title>Consultation Form Page</title>
    <style>

        .content-text .col-a{
            margin-left: -160px
        }

        .content-text .col-b {
            margin-left: 0;
        }

        .content-text .col-b h5 {
            margin-left: 250px;
        }
        .body-upper-text{
            margin-top: 159px;
        }

        .menu-drop-icon{
            display: none;
        }

        @media screen and (max-width: 768px){
            .container-inner {
                display: flex;
                justify-content: space-between;
                margin-top: -20px;
                left: 0;
            }
            .content-text{
                display: none;
            }

            .menu-drop-icon{
                display: block;
            }

            .buttons{
                margin-top: 94px;
                margin-left: 102px;
            }

            .body-upper-text{
                margin-top:  173px;
                margin-left: 38px;
            }


            .container-inner .menu-drop-icon {
                text-align: right;
                margin-right: 10px;
            }

        }

    </style>
@stop

@section('content')
        <div class="body-upper-text mt-4">
            <h5>신한카드 단독 제휴, 48개월 초슬림 할부 금융 솔루션</h5>
        </div>

        <div class="main-form">
            <h4><img src=" {{ themes('images/pointer.png') }}"> 가맹 상담 신청</h4>
            <form>
                <div class="form-group">
                    <label for="name">회사명<b>*</b></label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="company_register_number">사럽자 등록번호<b>*</b></label>
                    <input type="number" id="number" name="company_register_number" placeholder="숫자만 입력해 주세요" required>
                </div>
                <div class="form-group">
                    <label for="position">담당자 성명 / 직책<b>*</b></label>
                    <input type="text" id="position" name="position" required>
                </div>
                <div class="form-group">
                    <label for="contact_email">담당자 E.mail<b>*</b></label>
                    <input type="email" id="contact_email" name="contact_email" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">담당자 전화번호<b>*</b></label>
                    <input type="phone" id="phone_number" name="phone_number" placeholder="숫자만 입력해 주세요" required>
                </div>
                <div class="form-group">
                    <label for="inquiry">문의사항</label>
                    <textarea id="inquiry" name="inquiry" rows="4" placeholder="숫자만 입력해 주세요"></textarea>
                </div>
                <div class="form-group">
                    <div class="checkbox-container">
                        <input type="checkbox" id="essential" class="checkbox-input">
                        <label for="essential" class="checkbox-label">위 개인정보 수집, 이용에 동의합니다. <b>(필수)</b></label>
                    </div>
                    <div class="checkbox-container">
                        <input type="checkbox" id="third-parties" class="checkbox-input">
                        <label for="third-parties" class="checkbox-label">위 개인정보 제3자 제공에 동의합니다. <b>(필수)</b></label>
                    </div>
                </div>
                <button class="btn btn-outline-secondary" value="Submit">신청하기</button>
            </form>
        </div>
@endsection
