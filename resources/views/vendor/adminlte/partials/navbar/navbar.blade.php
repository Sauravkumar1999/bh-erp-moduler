<nav
    class="layout-navbar container-xxl navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand-xl') }}
    {{ config('adminlte.classes_topnav', 'navbar-detached align-items-center bg-navbar-theme') }}"
     id="layout-navbar">


    {{-- sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        </ul>
    </div>

</nav>
