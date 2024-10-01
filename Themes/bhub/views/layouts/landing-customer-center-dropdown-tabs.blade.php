<div class="d-md-flex d-none d-md-block dropdown-tabs-customer">
    <h5><a class="{{ Request::routeIs('monthly-news.view') ? 'activeclass nul' : '' }}" href="{{ route('monthly-news.view') }}">월간뉴스</a></h5>
    <h5><a class="{{ Request::routeIs('faq') ? 'activeclass nul' : '' }}" href="{{ route('faq') }}">자주하는 질문 (FAQ)</a></h5>
    <h5><a class="{{ Request::routeIs('instructions') ? 'activeclass nul' : '' }}" href="{{ route('instructions') }}">이용 안내 및 문의</a></h5>
    <h5><a class="{{ Request::routeIs('way-to-come') ? 'activeclass nul' : '' }}" href="{{ route('way-to-come') }}">오시는 길</a></h5>
</div>

<style>
    .activeclass {
        color: var(--main2, #EC661A) !important;
        font-weight: 600 !important;
    }

    .nul{
        border-bottom: 2px solid #EC661A;
        padding: 23px 0px;
    }
</style>
