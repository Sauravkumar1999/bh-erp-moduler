<!DOCTYPE html>
<html lang="ko">

<head>
    @include('views.google-tags.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (setting('rental_mall_enabled', 1))
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/styles.css') }}">
    <title>{{ $title.config('adminlte.user_configured_title', '')  }}</title>
</head>

@php($logout_url = config('adminlte.logout_url', 'logout'))

<body>
    @include('views.google-tags.body')
    @include('views.layouts.topbar', [
        'settings' => $userSettings,
        'user' => $user,
    ])
    @section('sidebar')

    @show
    <main>
        @yield('content')
    </main>
</body>
@include('views.layouts.footer')
@if (setting('rental_mall_enabled', 1))
<script src="{{ asset('vendor/vuexy/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endif
<script src="{{ asset('vendor/vuexy/vendor/libs/clipboard/clipboard.js') }}"></script>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('script')

</html>
