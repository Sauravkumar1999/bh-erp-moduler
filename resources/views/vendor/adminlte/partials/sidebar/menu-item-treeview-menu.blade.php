<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="menu-item {{ $item['submenu_class'] }} {{ $item['class'] }} @if($item['class'] === 'active') {{'open'}} @endif">

    {{-- Menu toggler --}}
    <a class="menu-link menu-toggle @isset($item['shift']) {{ $item['shift'] }} @endisset"
       href="" {!! $item['data-compiled'] ?? '' !!}>

        <i class="menu-icon {{ $item['icon'] ?? 'tf-icons ti ti-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>

        <div>
            {{ $item['text'] }}

            @isset($item['label'])
                <div class="badge badge-{{ $item['label_color'] ?? 'primary' }} rounded-pill ms-auto">
                    {{ $item['label'] }}
                </div>
            @endisset
        </div>

    </a>

    {{-- Menu items --}}
    <ul class="menu-sub">
        @each('adminlte::partials.sidebar.menu-item', $item['submenu'], 'item')
    </ul>

</li>
