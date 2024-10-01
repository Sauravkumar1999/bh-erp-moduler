<aside id="layout-menu" class="layout-menu {{ config('adminlte.classes_sidebar', '') }}">

    {{-- Sidebar brand logo --}}
    <div class="app-brand demo">
        @if(config('adminlte.logo_img_xl'))
            @include('adminlte::partials.common.brand-logo-xl')
        @else
            @include('adminlte::partials.common.brand-logo-xs')
        @endif
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    {{-- Sidebar menu --}}
    <ul class="menu-inner py-1">
        @php
            $menuItems = $adminlte->menu('sidebar');
            $menuItems =  sort_menu($menuItems);
        @endphp

        {{-- Configured sidebar links --}}
        @each('adminlte::partials.sidebar.menu-item', $menuItems, 'item')
        @if (setting('royal_membership_active', 1) && !user()->isAdmin() && !is_royal_application())
        <div class="menu-item royal-member-application">
            <button onclick="return window.location.href='{{ route('admin.apply-royal-member') }}'">
                <span>
                    @if (user()->end_date != null && now() <= user()->end_date)
                        {{ trans('user::user.royal-member-extend') }}
                    @else
                        {{ trans('user::user.royal-member-apply') }}
                    @endif
                </span>
                <img src="{{ asset('images/paid-icon-header.svg') }}" alt="">
            </button>
        </div>
        @endif
    </ul>

</aside>
