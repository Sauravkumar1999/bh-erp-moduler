@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<!-- User badge -->
@if (setting('royal_membership_active', 1) && is_royal_member())
<li class="nav-item  dropdown me-2 me-xl-0 p-2">
<img class="user_badge_header" src="{{ asset('images/paid-icon-header.svg') }}"alt="paid" class="img-fluid">
</li>
@endif
<!-- User badge -->

<!-- language dropdown -->
<li class="nav-item  dropdown me-2 me-xl-0">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
        <i class="ti ti-language rounded-circle ti-md"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end " data-bs-popper="static">

        @php( $locale = session()->has('locale') ? session()->get('locale') : 'en' )

        @foreach(languages() as $lang)
            <li>
                <a class="dropdown-item @if($locale == $lang->slug) active @endif" href="{{ route('admin.switch-locale', ['lang' => $lang->slug]) }}">
                    <span class="align-middle">@lang('translation::language.'.$lang->slug)</span>
                </a>
            </li>
        @endforeach
    </ul>
</li>
<!-- language dropdown -->

<!-- User -->
<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        {{-- <div class="avatar avatar-online">
            @if(config('adminlte.usermenu_image'))
                <img src="{{ Auth::user()->avatar() }}"
                     class="h-auto rounded-circle"
                     alt="{{ Auth::user()->full_name }}">
            @else
                <span>{{ Auth::user()->full_name }}</span>
            @endif
        </div> --}}
        @auth
            <span class="fw-medium d-block">{{ Auth::user()->full_name }}</span>
        @endauth
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="#">
                <div class="d-flex">
                    {{-- @if(config('adminlte.usermenu_image'))
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">

                                    <img src="{{ Auth::user()->avatar() }}"
                                         class="h-auto rounded-circle"
                                         alt="">
                            </div>
                        </div>
                    @endif --}}
                    <div class="flex-grow-1">
                        @auth
                            <span class="fw-medium d-block">{{ user()->full_name }}</span>
                        @endauth
                    </div>
                </div>
            </a>
        </li>
        {{-- <li>
            <div class="dropdown-divider"></div>
        </li>
        @if($profile_url)
            <li>
                <a class="dropdown-item" href="{{ $profile_url }}">
                    <i class="ti ti-user-check me-2 ti-sm"></i>
                    <span class="align-middle">{{ __('adminlte::menu.profile') }}</span>
                </a>
            </li>
        @endif
        <li>
            <div class="dropdown-divider"></div>
        </li> --}}
        @if(Auth::check())
            <li>
                @if (auth()->user())
                    <a class="dropdown-item" href="{{url('sales/my-page/'.auth()->user()->code)}}">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <span class="fw-medium d-block">{{ __('user::menu.go-to-my-page') }}</span>
                            </div>
                        </div>
                    </a>
                @endif
            </li>
        @endif

        <li>
            @if (auth()->user())
                <a class="dropdown-item" href="{{ url('/') }}">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <span class="fw-medium d-block">@lang('user::sale.bizhub-homepage')</span>
                        </div>
                    </div>
                </a>
            @endif
        </li>

        <li>
            <form id="logout-form" action="{{ $logout_url }}" method="POST">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
                <button type="submit" class="dropdown-item"><i class="ti ti-logout me-2 ti-sm"></i>
                    <span class="align-middle">Logout</span></button>
            </form>
        </li>
    </ul>
</li>
<!--/ User -->
