<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=1024, initial-scale=1.0"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/step-registration/step-registration.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <title>{{ trans('user::biz-planner.title').config('adminlte.title_postfix', '') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! get_meta_data() !!}
    @stack('css')
</head>

<body>
    <main>
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('vendor/step-registration/step-registration.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    @stack('scripts')
</body>

</html>
