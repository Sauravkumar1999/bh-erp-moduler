<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('landing/bh-slides/slides.css') }}">
    <link rel="stylesheet" href="{{ themes('css/font.css') }}" />

    <title>slide1</title>
    <style>
        .slider-body {
            max-width: 1600px !important;
            margin: auto !important;
            display: grid;
            justify-content: center;
        }

        .image__btn {
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 15px 0 0;
        }

        .image__btn img {
            width: 100%;
            max-width: 90px;
        }

        .image__btn .group__btn {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .image__btn .group__btn>* {
            border-radius: 5px !important;
        }

        .image__btn .group__btn>button:hover {
            background: #fff !important;
            color: #ec661a;
            border: 1px solid #ec661a;
        }

        .image__btn .group__btn>*.outline__btn {
            background: #fff !important;
            color: #ec661a;
        }

        .image__btn .group__btn>*.outline__btn:hover {
            color: #fff !important;
            background: #ec661a !important;
        }

        .left-content p {
            font-family: Pretendard;
            font-size: 24px;
            font-weight: 500;
            line-height: 32px;
            text-align: left;

        }

        .left-content h3 {
            font-family: Pretendard;
            font-size: 40px;
            font-weight: 700;
            line-height: 47.73px;
            text-align: left;
            color: #EC661A;

        }
        #button-1:hover {
            background-color: #e15a11 !important;
            color: #fff;
        }
    </style>
</head>

<body class="slider-body" style="background-color: rgba(241, 248, 255, 1)">
    <div class="left-content">
        <p>좋은 영업 아이템들만 한 곳에서 모았습니다.<br />
            나만의 스타일로 성공 HUB를 만드세요.</p>
        <h3>개인 맞춤형 멀티 세일즈 플랫폼</h3>
        <div class="image__btn">
            <img src="{{ themes('images/bh-slides/myHublogo.png') }}" alt="logo">
            <div class="group__btn">
                <button type="button" onclick="redirectUrl('{{ route('install-app')}}')" class="btn btn-primary" id="button-1"><b>앱다운로드</b></button>
                <button type="button" onclick="redirectUrl('{{ route('greeting') }}')"
                    class="btn btn-primary outline__btn" id="button-1"><b>더 자세한 정보</b></button>
            </div>
        </div>
    </div>
    <div class="trapezoid">
    </div>
    <div class="card">
        <div class="card-content-texts">
            <h6>[중요 공지]</h6>
            <h5>기존 지사대표님들!</h5>
            <h4><b>“My Hub”앱을 설치하세요.</b></h4>
        </div>
        <div class="card-img">
            <img src="{{ themes('images/card_myhub.png') }}" alt="logo">
        </div>
    </div>
    <script>
        function redirectUrl(url) {
            event.preventDefault();
            window.parent.location.href = url;
        }
    </script>
</body>

</html>
