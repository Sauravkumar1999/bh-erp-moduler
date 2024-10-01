<!DOCTYPE html>
<html lang="ko">

<head>
    @include('views.google-tags.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/styles.css') }}">
    <link rel="stylesheet" href="{{ themes('css/sales/master.css') }}">
    {!! get_meta_data() !!}
    @yield('css')
    <title>{{ $title.config('adminlte.user_configured_title', '')  }}</title>

    <style>
        div.text-center .bhub-submit-btn {
            font-size: 1.2rem !important;
            background-color: rgba(236, 102, 26, 0.26) !important;
        }
        div.text-center .bhub-submit-btn:disabled {
            font-size: 1.2rem !important;
            opacity: 1.0 !important;
            background-color: rgba(236, 102, 26, 0.05) !important;
        }
    </style>
</head>

<body class="px-0">
    @include('views.google-tags.body')
    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                var windowHeight = $(window).height();
                var documentHeight = $(document).height();
                let calculated_length = documentHeight - windowHeight
                if (calculated_length > 200) {
                    $(window).scroll(function() {
                        if ($(this).scrollTop() > 100) {
                            $('.header__wrapper').addClass('position-fixed');
                        } else {
                            $('.header__wrapper').removeClass('position-fixed');
                        }
                    });
                }
            });
            $("#mobile_header #menubtn").click(function() {
                $("#desktop_header").slideToggle(300);
            });
        });
    </script>
    @yield('js')
    @stack('scripts')
</body>

</html>
