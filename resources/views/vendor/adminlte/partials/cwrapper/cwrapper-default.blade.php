@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

{{-- Default Content Wrapper --}}
<div class="content-wrapper {{ config('adminlte.classes_content_wrapper', '') }}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
            {{-- Content Header --}}
            @hasSection('content_header')
                @yield('content_header')
            @endif

            @include('adminlte::partials.common.flash-alerts')

            {{-- Main Content --}}
            @yield('content')
            </div>
        </div>
    </div>
</div>
