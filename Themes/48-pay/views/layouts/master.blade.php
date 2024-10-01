<!DOCTYPE html>
<html lang="ko">

<head>
    @include('views.google-tags.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/main.css') }}">
    <link rel="stylesheet" href="{{ themes('css/footer.css') }}">
    {{-- <link rel="stylesheet" href="{{ themes('landing/css/bh-footer.css') }}"> --}}
    <link rel="stylesheet" href="{{ themes('css/header.css') }}">
    @yield('css')
    <style>
        body {
            font-family: "Pretendard" !important;
        }
    </style>
    <title>@yield('title')</title>
</head>

<body>
    @include('views.google-tags.body')
    <div class="container-fluid">
        @include('views.layouts.header')
        <main>
            @yield('content')
        </main>
    </div>

    <div id="footer-container">
        @include('views.layouts.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('js')
</body>
</html>
