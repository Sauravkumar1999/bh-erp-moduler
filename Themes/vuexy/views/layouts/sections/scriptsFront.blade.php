
<!-- BEGIN: Vendor JS-->
<script src="{{ asset('vendor/vuexy/vendor/js/dropdown-hover.js')}}"></script>
<script src="{{ asset('vendor/vuexy/vendor/js/mega-dropdown.js')}}"></script>
<script src="{{ asset('vendor/vuexy/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('vendor/vuexy/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('vendor/vuexy/vendor/js/bootstrap.js') }}"></script>

@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset('vendor/vuexy/js/front-main.js') }}"></script>
<!-- END: Theme JS-->
<!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->
