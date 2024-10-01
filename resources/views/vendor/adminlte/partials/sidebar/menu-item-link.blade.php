<li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="menu-item {{ $item['class'] }}">

    <a class="menu-link @isset($item['shift']) {{ $item['shift'] }} @endisset"
       href="{{ $item['href'] }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
       {!! $item['data-compiled'] ?? '' !!}>

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

</li>
