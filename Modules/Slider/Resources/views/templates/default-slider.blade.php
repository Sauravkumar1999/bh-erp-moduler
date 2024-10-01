<style>
    .default-slide .left-content {
        width: 520px;
        height: 276px;
        gap: 16px;
        margin-top: 130px;
    }

    .slider-body {
        max-width: 100% !important;
        display: grid;
        position: relative;
        justify-content: center;

    }

    .left-content p {
        font-size: 24px;
        font-weight: 500;
        line-height: 32px;
        text-align: left;
    }

    .left-content h3 {
        font-size: 40px;
        font-weight: 700;
        line-height: 47.73px;
        text-align: left;
        color: #EC661A;
    }

    .image__btn {
        display: flex;
        align-items: center;
        gap: 20px;
        margin: 15px 0 0;

    }

    .image__btn .group__btn {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .slide-container.btn.btn-primary {
        border-radius: 10px;
        width: 120px;
        border: 1px solid rgba(236, 102, 26, 1);
        background: rgba(236, 102, 26, 1);
        color: white;
        margin: 0px;

    }

    .image__btn .group__btn>*.outline__btn {
        background: #fff !important;
        color: #ec661a;
    }

    .text-inside {
        margin-top: 30px;
        margin-bottom: 10px;
    }

    .card {
        background-color: white;
        width: 565px;
        height: 300px;
        border-radius: 20px;
        margin-top: -330px;
        margin-left: 600px;

    }

    .card.slider-card {
        background-color: white;
        width: 565px;
        max-height: 300px;
        border-radius: 20px;
        margin-top: -330px;
        margin-left: 600px;
        padding: 0px !important;
    }

    .logo-container {
        position: relative;
        display: flex;
        justify-content: end;
        margin-top: 118px;
        margin-right: 5px;
        padding-right: 15%;
    }

    .logo-container img {
        height: 60px;
        width: 60px;
    }

    .trapezoid {
        position: absolute;
        top: 0;
        right: 0;
        width: 50vw;
        height: 100%;
        background-color: #FD6F22;
        clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%);
    }

    .card-content-texts {
        margin-left: 50px;
        margin-top: 60px;
    }

    .card-content-texts h6 {
        font-weight: 500;
    }

    .card-content-texts h6 b {
        color: #FD6F22;
        font-weight: 500;
    }

    .card-content-texts h5 {
        margin-top: 20px;
    }

    .card-img img {
        margin-left: 400px;
        margin-top: -160px;
        width: 100px;
    }

    .logo-container1 {
        position: relative;
        display: flex;
        justify-content: end;
        margin-top: 118px;
        margin-right: 5px;
        padding-right: 15%;
    }

    .logo-container1 img {
        height: 60px;
        width: 60px;
    }


    /* for slide-2 only */

    .card-content-texts2 h4 b {
        color: rgba(0, 86, 187, 1) !important;
    }

    .card-img2 img {
        margin-left: 260px;
        margin-top: -60px;
        width: 280px;
    }

    .card-content-texts2 {
        margin-left: 40px;
        margin-top: 60px;
    }

    .card-content-texts2 h5 {
        margin-top: 20px;
    }

    .card-content-texts3 h5 {
        color: rgba(86, 31, 125, 1) !important;
        font-weight: 800;
    }

    .card-content-texts3 {
        margin-left: 50px;
        margin-top: 80px;
    }

    .card-img3 img {
        margin-left: 350px;
        margin-top: -10px;
        width: 150px;
    }

    .card-content-texts4 h4 b {
        color: rgba(144, 195, 31, 1) !important;
    }

    .card-img4 img {
        margin-left: 260px;
        margin-top: -100px;
        width: 280px;
    }

    .card-content-texts4 {
        margin-left: 60px;
        margin-top: 60px;
    }


    .dot {
        height: 9px;
        width: 9px;
        background-color: #999898;
        border-radius: 50%;
        display: inline-block;
        margin-right: 0.1rem !important;
        margin-left: 0.1rem !important;
        cursor: pointer;
    }

    .activedot {
        width: 20px;
        border-radius: 0.25rem !important;
        background-color: #4f4a4a;

    }

    @media screen and (max-width:768px) {
        .slider-dots {
            top: 92%;
            position: absolute;
            margin: auto;
        }
    }


    @media screen and (min-width: 1440px) {
        .card {
            width: 595px;
            height: 320px;
        }

        .left-content {
            width: 580px;
            height: 286px;
            gap: 16px;
            margin-top: 140px;
        }

        .logo-container {
            margin-top: 67px;
        }

        .logo-container1 {
            margin-top: 75px;
        }
    }

    @media screen and (max-width:768px) {
        .left-content {
            width: auto !important;
            margin-top: 30px !important;
            margin-left: 0;
            padding: 20px;
            z-index: 1;
            text-align: center;
        }

        .card {
            width: auto !important;
            margin-top: 8% !important;
            margin-left: 10px !important;
            margin-right: 10px !important;
            flex-direction: row;
            height: auto !important;
        }

        .image__btn {

            justify-content: center !important;
            margin: 30px 0 0 !important;
        }

        .left-content p {
            text-align: center !important;
            font-size: 16px !important;
        }

        .left-content h3 {
            text-align: center !important;
            font-size: 24px !important;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .slider-card div.card-img {
            width: auto;
            margin-left: 0px;
            padding: 20px;
            margin-top: 0px;
        }

        .slider-card div.card-img img {
            margin-left: 0;
            margin-top: 0;
            width: 60px;
        }

        .slider-card div.card-img2,
        .slider-card div.card-img3,
        .slider-card div.card-img4 {
            display: flex !important;
            justify-content: center !important;
            align-items: end !important;
        }

        .slider-card div.card-img2 img {
            margin-left: -10px;
            margin-top: 0;
            width: 90px;
        }

        .slider-card div.card-img3 img {
            margin-left: 0;
            margin-top: 0;
            width: 75px;
            padding-bottom: 20px;
        }

        .slider-card div.card-img4 img {
            margin-left: 0;
            margin-top: 0;
            width: 100px;
            padding-bottom: 20px;
        }

        /* .trapezoid {

            position: fixed;
            top: 0;
            right: 0;
            width: 50vw;
            height: 100vh;
            background-color: #FD6F22;
            clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%);

        } */

        .card-content-texts,
        .card-content-texts2,
        .card-content-texts3,
        .card-content-texts4 {
            margin-left: 0px;
            padding: 20px;
            padding-right: 0px;
            margin-top: 0px;
        }

        .card-content-texts h6,
        .card-content-texts2 h6,
        .card-content-texts3 h6,
        .card-content-texts4 h6 {
            font-weight: 300;
        }

        .card-content-texts h6 b,
        .card-content-texts2 h6 b,
        .card-content-texts3 h6 b,
        .card-content-texts4 h6 b {
            color: #FD6F22;
            font-weight: 300;
        }

        .card-content-texts h4 b,
        .card-content-texts2 h4 b,
        .card-content-texts3 h4 b,
        .card-content-texts4 h4 b {
            color: #FD6F22;
            font-weight: bold;
        }

        .h4,
        h4 {
            font-weight: 400 !important;
            font-size: 16px !important;
        }

        .h5,
        h5 {
            font-size: 16px !important;
            font-weight: 400 !important;
        }

        .slider-card div.card-content-texts h6 {
            font-size: 14px;
            font-weight: 500 !important;
        }

        .slider-card div.card-content-texts2 h6 {
            font-size: 16px;
            font-weight: 400 !important;
        }

        .slider-card div.card-content-texts3 h5 {
            font-weight: 700 !important;
        }

        .slider-card div.card-content-texts3 h6 {
            font-size: 14px;
            font-weight: 400 !important;
        }

        .slider-card div.card-content-texts3 h7 {
            font-size: 14px !important;
            font-weight: 400 !important;
        }

        .slider-card div.card-content-texts4 h6 {
            font-size: 16px !important;
            font-weight: 500 !important;
        }

        .slider-card div.card-content-texts4 h6 b {
            font-size: 16px !important;
            font-weight: 400 !important;
        }

        .slider-dots {
            top: 92%;
            position: absolute;
            margin: auto;
        }

        .trapezoid {
            position: absolute;
            top: 20%;
            right: 0;
            width: 100%;
            height: 100%;
            background-color: #FD6F22;
            clip-path: polygon(-35% 100%, 100% 20%, 100% 100%, 0% 100%);
        }

        .image__btn .group__btn>*.outline__btn {
            position: relative;
            z-index: 9;
        }
    }

    @media screen and (min-width: 2560px) and (min-height: 1440px) {
        .btn.btn-primary {
            width: 200px !important;
        }
    }
    #button-1:hover {
            background-color: #e15a11 !important;
            color: #fff;
        }
</style>
<div class="slide-container slider-body">
    @foreach ($slider->items as $key => $item)
        @if ($item->status)
            <div class="default-slide">
                <div class="left-content">
                    <p>좋은 영업 아이템들만 한 곳에서 모았습니다.<br />
                        나만의 스타일로 성공 HUB를 만드세요.</p>
                    <h3>개인 맞춤형 멀티 세일즈 플랫폼</h3>
                    <div class="image__btn">
                        <img src="{{ themes('images/bh-slides/myHublogo.png') }}" alt="logo">
                        <div class="group__btn">
                            <button type="button" onclick="return window.location.href='{{ route('install-app')}}'" class="btn btn-primary" id="button-1"><b>앱다운로드</b></button>
                            <button type="button" onclick="return window.location.href='{{ route('greeting')}}'" class="btn btn-primary outline__btn" id="button-1"><b>더 자세한
                                    정보</b></button>
                        </div>
                    </div>
                </div>
                @if ($key === 0)
                    <div class="trapezoid"></div>
                @endif
                @php
                    $a = $key + 1;
                    // Define an array of manual image URLs
                    // $manualImages = [
                    //     themes('images/card_myhub.png'),
                    //     themes('images/announcement.png'),
                    //     themes('images/p2u.png'),
                    //     themes('images/humancell.png'),
                    // ];
                    // $manualImageIndex = $key % count($manualImages);
                @endphp
                <div class="card slider-card" style="cursor: pointer"
                    @if ($item->url && Illuminate\Support\Facades\URL::isValidUrl($item->url)) onclick="redirectUrl('{{ $item->url }}')" @endif>
                    <div class="card-content-texts{{ $a > 1 ? '' . $a : '' }}">
                        {!! $item->custom_html !!}
                    </div>
                    <div class="card-img{{ $a > 1 ? '' . $a : '' }}">
                        <img src="{{ $item->image() }}" alt="logo">
                        {{-- <img src="{{ $manualImages[$manualImageIndex] }}" alt="logo"> --}}
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <div class="slider-dots"></div>
</div>
<script>
    function redirectUrl(url) {
        event.preventDefault();
        window.parent.location.href = url;
    }
    const slides = document.querySelectorAll('.default-slide');
    if (slides.length > 0) {
        const slideContainer = slides[0].parentElement;
        const dotsContainer = document.querySelector('.slider-dots');
        let currentSlide = 0;
        const colors = ['rgb(247 247 247)', 'rgba(241, 248, 255, 1)', 'rgba(175, 207, 37, 0.1)',
            ' linear-gradient(266.82deg, rgba(144, 195, 31, 0.36) 2.13%, rgba(144, 195, 31, 0.15) 34.53%, rgba(144, 195, 31, 0.25) 98.8%)'
        ];

        function animator(slide) {
            const spining = [{
                    opacity: 0.2
                },
                {
                    opacity: 1
                }
            ];
            const timer = {
                duration: 3000,
                iterations: 1,
            };
            const card = slide.querySelector(".card");
            card.animate(spining, timer);
        }
        // Show the first slide on initial load
        slides[0].style.display = 'block';
        slides[0].style.opacity = 0.2;
        const duration = 2000; // milliseconds
        const fps = 36; // frames per second
        const frames = duration / 1000 * fps; // total frames
        let frame = 0;
        const opacityIncrement = (1 - 0.2) / frames;

        function animateOnLoad() {
            slides[0].style.opacity = parseFloat(slides[0].style.opacity) + opacityIncrement;

            frame++;
            if (frame < frames) {
                setTimeout(animateOnLoad, 1000 / fps);
            } else {
                slides[0].style.opacity = 1;
            }
        }

        animateOnLoad();

        // Create dots for each slide
        slides.forEach((slide, index) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (index === 0) {
                dot.classList.add('activedot');
            }
            dot.addEventListener('click', () => {
                showSlide(index);
            });
            dotsContainer.appendChild(dot);
        });

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    currentSlide = index;
                    slide.style.display = 'block';
                } else {
                    slide.style.display = 'none';
                }
                animator(slide);
            });
            // Update active dot
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('activedot');
                } else {
                    dot.classList.remove('activedot');
                }
            });
            slideContainer.style.backgroundColor = colors[index];
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        setInterval(nextSlide, 5000);
    }
</script>
