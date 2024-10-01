<!DOCTYPE html>
<html lang="ko">

<head>
    @include('views.google-tags.head')
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/bh-header.css') }}">
    <link rel="stylesheet" href="{{ themes('landing/css/bh-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ themes('css/font.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/sweetalert2/sweetalert2.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>{{ $title.config('adminlte.title_postfix', '')  }}</title>
    {!! get_meta_data() !!}
    <style>
        body {
            font-family: "Pretendard" !important;
        }
        @media screen and (max-height: 82vh){
            main {
                /* min-height: 78vh !important; */
                min-height: 82vh !important;
            }
        }

        @media screen and (min-height: 82vh) and (max-height: 85vh){
            main {
                min-height: 85vh;
            }
        }

        @media screen and (min-height: 85vh) and (max-height: 100vh) {
            main {
                min-height: 77vh;
            }
        }
    </style>
    @stack('css')
</head>

<body>
    @include('views.google-tags.body')
    <div id="header-container">
        @include('views.layouts.landing-header')
    </div>
    <main>
        @yield('content')
    </main>
    <div id="footer-container">
        @include('views.layouts.landing-footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    @stack('scripts')
</body>

</html>
