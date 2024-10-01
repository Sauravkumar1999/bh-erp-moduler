@extends('layouts.landing-layout', ['title' => '오시는 길 > 고객센터'])
<meta name="viewport" content="width=device-width, initial-scale=1">
@push('css')
    <link rel="stylesheet" href="{{ themes('css/monthlynews.css') }}">
    <link rel="stylesheet" href="{{ themes('css/waytocome.css') }}">
    <style>
        .location-google {
            margin: 0 auto;
            width: 90%;
            height: 450px;
            border: 0;
        }
    </style>
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "고객센터 &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;오시는 길"])
    @include('layouts.landing-customer-center-dropdown-tabs')
    <div class="map-container">
        <div class="heading">
            <h3><b>오시는 길</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
            <div class="location-google" id="googleMap">
            </div>
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3165.3777718662795!2d127.04097057553776!3d37.49900732799807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1z7ISc7Jq47IucIOqwleuCqOq1rCDslrjso7zroZwgNzXquLggOCwgVEnruYzrlKkgMuy4tQ!5e0!3m2!1sen!2slk!4v1712054935038!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}

            <div class="map-below-content">
                <div class="heading">
                    <h4><b>대중 교통 이용 안내</b></h4>
                </div>
                <div class="footer-layout">
                    <div>
                        <button class="footer-list-btn btn">지하철</button>
                        <p>역삼역 (2호선) 1번 출구, <span>도보 12분</span>
                        <p>
                        <p>선릉역 (2호선, 수인분당선) 4번 출구, <span>도보 14분</span>
                        <p>
                        <p>한티역 (수인분당선) 7번 출구, <span>도보 17분</span>
                        <p>
                    </div>
                    <div>
                        <button class="footer-list-btn btn mb-4">버스</button>
                        <div class="flexlayout">
                            <button class="blue-btn btn">간선</button>
                            <p>#141, 147, 242, 350, 361, N64</p>
                        </div>
                        <div class="flexlayout">
                            <button class="btn green-btn">일반</button>
                            <p>#강남07</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script async defer src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script> --}}
    <script>
        function initMap() {
            var mapProp = {
                center: new google.maps.LatLng(37.499028, 127.043545),
                zoom: 16, // Increase the zoom level to show a smaller area
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var marker = new google.maps.Marker({
                position: mapProp.center,
                map: map,
                title: '서울시 강남구 언주로 75길 8, TI빌딩 2층'
            });
        }
    </script>

    <script src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
@endpush
