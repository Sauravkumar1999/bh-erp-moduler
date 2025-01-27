<div class="cus__card" style="cursor: pointer">
    <a href="{{ $item['main_url'] }}" class="text-decoration-none{{ $item['product_name'] == '렌탈몰' ? ' rental_mall_card' : '' }}">
        @php($product = \Modules\Product\Entities\Product::find($item['id']))
        <div class="cus__card__image">
            {{-- <img src="https://bh-dev-erp.businesshub.co.kr/media/image/68" class="card-img-top" alt="..."> --}}
            <img src="{{ $product->banner() }}" class="card-img-top" alt="...">
        </div>
        <div class="cus__card__body">
            <h4 class="cus__card__title">{{ $item['product_name'] }}</h4>
            <p class="cus__card__text">{{ $item['product_description'] }}</p>
            <div class="share__icon">
                <button type="button" class="btn clipboard-copy-item" data-clipboard-text="{{ isset($item['main_url']) ? $item['main_url']  : '#' }}"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="주소가 복사되었습니다." data-bs-trigger="click">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-light" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M18 16.12C17.24 16.12 16.56 16.42 16.04 16.89L8.91 12.74C8.96 12.51 9 12.28 9 12.04C9 11.8 8.96 11.57 8.91 11.34L15.96 7.22998C16.5 7.72998 17.21 8.03998 18 8.03998C19.66 8.03998 21 6.69998 21 5.03998C21 3.37998 19.66 2.03998 18 2.03998C16.34 2.03998 15 3.37998 15 5.03998C15 5.27998 15.04 5.50998 15.09 5.73998L8.04 9.84998C7.5 9.34998 6.79 9.03998 6 9.03998C4.34 9.03998 3 10.38 3 12.04C3 13.7 4.34 15.04 6 15.04C6.79 15.04 7.5 14.73 8.04 14.23L15.16 18.39C15.11 18.6 15.08 18.82 15.08 19.04C15.08 20.65 16.39 21.96 18 21.96C19.61 21.96 20.92 20.65 20.92 19.04C20.92 17.43 19.61 16.12 18 16.12Z"
                            fill="#666666" />
                    </svg>
                </button>
            </div>
        </div>

    </a>
</div>
