<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('vendor/vuexy') }}/" data-template="vertical-menu-template">

<head>
    {!! view('google-tags.head') !!}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/tabler-icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/fonts/flag-icons.css') }}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/css/rtl/core.css') }}"
            class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/css/rtl/theme-default.css') }}"
            class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/css/demo.css') }}" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/node-waves/node-waves.css') }}" />
        <link rel="stylesheet"
            href="{{ asset('vendor/vuexy/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/typeahead-js/typeahead.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/apex-charts/apex-charts.css') }}" />
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/swiper/swiper.css') }}" />
        <link rel="stylesheet"
            href="{{ asset('vendor/vuexy/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet"
            href="{{ asset('vendor/vuexy/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
        <link rel="stylesheet"
            href="{{ asset('vendor/vuexy/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

        <!-- Page CSS -->
        <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/css/pages/cards-advance.css') }}" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap">
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if (config('adminlte.livewire'))
        @if (app()->version() >= 7)
            @livewireStyles()
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if (config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('vendor/vuexy/img/favicon/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"
            href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif
    <!-- Helpers -->
    <script src="{{ asset('vendor/vuexy/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('vendor/vuexy/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('vendor/vuexy/js/config.js') }}"></script>
</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {!! view('google-tags.body') !!}
    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if (!config('adminlte.enabled_laravel_mix'))
        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="{{ asset('vendor/vuexy/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/typeahead-js/typeahead.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/js/menu.js') }}"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('vendor/vuexy/vendor/libs/apex-charts/apexcharts.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ asset('vendor/vuexy/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('vendor/daum-api/daum.api.min.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('vendor/vuexy/js/main.js') }}"></script>
        <!-- <script type="text/javascript" src="{{ asset('/vendor/vuexy/js/extended-ui-perfect-scrollbar.js') }}"></script> -->


        <!-- Page JS -->

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if (config('adminlte.livewire'))

        @if (config('adminlte.livewire-modals'))
            <x-livewiremodal-base />
        @endif

        @if (app()->version() >= 7)
            @livewireScripts()
        @else
            <livewire:scripts />
        @endif

        <x-livewire-alert::scripts />

    @endif

    @if (config('adminlte.alpine'))
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @endif

    @if (config('adminlte.plugins.Datepicker.active'))
        <script type="text/javascript">
            $('.date-picker').datepicker({
                format: "{{ config('adminlte.date_format_js') }}",
                autoclose: true
            });
        </script>
    @endif

    @if (config('adminlte.plugins.Select2.active'))
        <script type="text/javascript">
            $('.bh-select2').select2({
                placeholder: function() {
                    $(this).data('placeholder');
                }
            });
        </script>
    @endif

    {{-- Custom Scripts --}}

    <script>
        /********************************************daum api****************************************************************/
        function FindPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    var addr = '';
                    if (data.userSelectedType === 'R') {
                        addr = data.roadAddress;
                    } else {
                        addr = data.jibunAddress;
                    }

                    if (data.userSelectedType === 'R') {
                        if (data.bname !== '' && /[to|to|to]$/g.test(data.bname)) {
                            extraAddr += data.bname;
                        }
                    }
                    document.getElementById('post_code').value = data.zonecode;
                    if (data.zonecode == '' || data.zonecode == null) {
                        document.getElementById('post_code').value = data.postcode1;
                        if (data.postcode1 == '' || data.postcode1 == null) {
                            document.getElementById('post_code').value = data.postcode2;
                        }
                    }
                    document.getElementById("address").value = addr;
                    //document.getElementById("address_detail").value = data.address;
                    document.getElementById("address_detail").focus();
                }
            }).open();
        }
        /********************************************daum api****************************************************************/
    </script>

    @yield('adminlte_js')

</body>

</html>
