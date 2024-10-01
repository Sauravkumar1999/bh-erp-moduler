@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Left Main Sidebar --}}
            @if(!$layoutHelper->isLayoutTopnavEnabled())
                @include('adminlte::partials.sidebar.left-sidebar')
            @endif
            <!-- Layout container -->
            <div class="layout-page">
                {{-- Top Navbar --}}
                @if($layoutHelper->isLayoutTopnavEnabled())
                    @include('adminlte::partials.navbar.navbar-layout-topnav')
                @else
                    @include('adminlte::partials.navbar.navbar')
                @endif

                {{-- Content Wrapper --}}
                @empty($iFrameEnabled)
                    @include('adminlte::partials.cwrapper.cwrapper-default')
                @else
                    @include('adminlte::partials.cwrapper.cwrapper-iframe')
                @endempty

                {{-- Footer --}}
                @hasSection('footer')
                    @include('adminlte::partials.footer.footer')
                @endif
            </div>
            {{-- Right Control Sidebar --}}
            @if(config('adminlte.right_sidebar'))
                @include('adminlte::partials.sidebar.right-sidebar')
            @endif
        </div>
    </div>
@stop

@section('adminlte_js')
    <script>
    $(document).ready(function(){
            $(".form-control").removeClass("form-control-sm");
            $(".form-select").removeClass("form-select-sm");
            $("#user-table_filter").removeClass('dataTables_filter');
        })
    </script>
    @if (!user()->isAdmin())
        <script>
            $('a[href="{{ route('admin.products.index') }}"], a[href="{{ route('admin.sales.index') }}"]').click(function(
                event) {
                event.preventDefault();
                var targetUrl = $(this).attr('href');
                Swal.fire({
                    icon: "info",
                    title: "준비 중",
                    showCloseButton: false,
                    showConfirmButton: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = targetUrl;
                    }
                });
            });
        </script>
    @endif
    @stack('js')
    @yield('js')
@stop
