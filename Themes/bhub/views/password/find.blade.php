@extends('layouts.landing-layout', ['title' => '비밀번호 찾기'])
@push('css')
    <style>
        .password-container {
            width: 450px;
            height: 453px;
            margin: auto;
            margin-top: 251px;
            gap: 40px;

        }

        .title-container {
            display: flex;
            justify-content: center;
            padding: 0px;
            margin-bottom: 20px;
            width: 100%;
        }

        .title {
            /* width: 130px; */
            height: 29px;
            font-size: 24px;
            font-weight: 700;
            line-height: 28.64px;
            color: #373737;

        }

        input[type=text],
        input[type=tel],
        input[type=number] {
            padding: 16px, 20px, 16px, 20px;
            border: 1px line #ECECEC;
            border-radius: 8px;
            height: 51px;
            width: 450px;
        }

        .form-certification input[type=text] {
            background-color: #F5F5F5;
        }

        form div {
            margin: 20px 0px;
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
            font-size: 16px;
            line-height: 19px;
            width: 87px;
            height: 19px;
            color: #646464;
        }

        .find-password {
            padding: 16px 20px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            background: rgba(236, 102, 26, 0.08);
            border: none;
            width: 100%;
        }

        .find-password span {
            color: #EC661A;
            font-weight: 400px;
            font-size: 16px;
            line-height: 19.2px;
        }

        .form-control:focus {
            border-color: #373737;
            box-shadow: none;
        }

        #certification_number {
            background-color: #F5F5F5;
        }
    </style>
@endpush


@section('content')
    <div class="password-container">
        <div class="title-container">
            <span class="title">비밀번호 찾기</span>

        </div>
        <form>
            <div class="form-group">
                <label for="id">아이디</label>
                <input type="text" class="form-control" placeholder="아이디" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="name">이름</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="이름" required>
            </div>

            <div class="form-group">
                <label for="phone_number">휴대폰 번호</label>
                <span class="input-btn">
                    <input type="tel" id="phone_number" name="phone_number" class="form-control"
                        placeholder="휴대폰 번호(- 없이 숫자만 입력)" required>
                    <button><span class="btn-title">인증번호 전송</span></button>

                </span>
            </div>

            <div class="form-group">
                <span class="input-btn">
                    <input type="text" id="certification_number" name="certification_number" class="form-control"
                        placeholder="인증번호 입력" required>
                    <button class="btn"><span class="btn-title">인증확인</span></button>
                </span>
            </div>

            <button class="find-password" value="비밀번호 찾기"><span>비밀번호 찾기</span></button>
        </form>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
