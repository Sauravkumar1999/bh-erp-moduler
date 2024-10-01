<div class="container-fluid pt-md-5 header__wrapper bg-white">
    <div class="row justify-content-end align-items-center" id="mobile_header">
        <div class="col-8">
            <a href="{{ url()->previous() }}" class="btn p-0" id="back-arrow">
                <img src="{{ themes('/images/arrow-up.png') }}" />
            </a>
            <img src="{{ themes('/images/myhublogo.png') }}" />
        </div>
        <div class="col-4 text-end">
            <button id="menubtn" class="btn btn-light">
                <img src="{{ themes('/images/bars.png') }}" />
            </button>
        </div>
    </div>
    <div class="row" id="desktop_header">
        <div class="col-6 back-arrow-col">
            <a href="{{ url()->previous() }}" class="btn p-0" id="back-arrow">
                <img src="{{ themes('/images/arrow-up.png') }}" />
            </a>
        </div>
        <div class="col-6 back-arrow-col-btn">
            <div class="text-end button__group">
                <a href="/" class="btn btn-outline-secondary">@lang('user::sale.bizhub-homepage')</a>
                @if (auth()->user())
                    <a href="{{ route('admin.my-info.edit', ['user' => auth()->user()]) }}"
                        class="btn btn-secondary">@lang('user::sale.my-page')</a>
                @endif
            </div>
        </div>
    </div>
</div>
