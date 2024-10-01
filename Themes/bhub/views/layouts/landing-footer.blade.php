
<style>
    .footer-sub-container{
        align-items: center;
    }
    .footer-container .footer-content .content-items{
    font-family: Pretendard;
    font-size: 14px;
    font-weight: 400;
    line-height: 16.71px;
}
</style>
<div class="footer-container">
    <div class="bg-dark navbar-footer">
        <div class="nav-footer-container">
            <div class="footer-sub-container">
                <div class="footer-logo">
                    <img src="{{ themes('images/bH-current-logo.png') }}" style="width: 146.22px; height: 46px;" alt="48pay-logo" />
                </div>
                <div class="footer-content">
                    <div class="content-items">
                        <div class="mobile-view-items d-block d-md-none">
                            <div class="items">상호명:(주)비즈니스허브</div>
                            <div class="vertical-divider"></div>
                            <div class="items">대표:김경배</div>
                            <div class="vertical-divider"></div>
                        </div>
                        {{-- desktop::begin --}}
                        <div class="d-none d-md-block items">상호명:(주)비즈니스허브</div>
                        <div class="d-none d-md-block vertical-divider"></div>
                        <div class="d-none d-md-block items">대표:김경배</div>
                        <div class="d-none d-md-block vertical-divider"></div>
                        {{-- desktop::end --}}

                        <div class="mobile-view-items d-block d-md-none">
                            <div class="items">서울시 강남구 언주로 75길 8, TI빌딩 2층</div>
                            <div class="vertical-divider"></div>
                            {{-- <div class="items">사업자등록번호:848-81-02807</div> --}}
                            {{-- <div class="vertical-divider"></div> --}}
                        </div>

                        {{-- desktop::begin --}}
                        <div class="d-none d-md-block items">서울시 강남구 언주로 75길 8, TI빌딩 2층</div>
                        <div class="d-none d-md-block vertical-divider"></div>
                        <div class="d-none d-md-block items">사업자등록번호:848-81-02807</div>
                        {{-- desktop::end --}}
                        <div class="mobile-view-items content-items mt-4 last-items">
                            <div class="d-block d-md-none items">사업자등록번호:848-81-02807</div>
                            <div class="d-block d-md-block vertical-divider"></div>
                            <div>{{ '대표번호:' . setting('bh_telephone', '') }}</div>
                            {{-- <div class="vertical-divider"></div> --}}
                            {{-- <div class="items">FAX:02-2054-8635</div> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
