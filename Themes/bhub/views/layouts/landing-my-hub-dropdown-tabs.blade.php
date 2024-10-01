<div class="d-md-block d-none dropdown-tabs-container">
    <div class="dropdown-pages-tab">
        <a href="{{ route('greeting') }}" class="{{ Request::routeIs('greeting') ? 'activeclass nul' : '' }}">인사말</a>
        <a href="{{ route('business-model') }}" class="{{ Request::routeIs('business-model') ? 'activeclass nul' : '' }}">비즈니스
            모델</a>
        <a href="{{ route('competitiveness') }}" class="{{ Request::routeIs('competitiveness') ? 'activeclass nul' : '' }}">“My
            HUB” 경쟁력</a>
        <a href="{{ route('branch-representative') }}" class="{{ Request::routeIs('branch-representative') ? 'activeclass nul' : '' }}">지사대표(BP)란?</a>
        <a href="{{ route('representative-registration') }}" class="{{ Request::routeIs('representative-registration') ? 'activeclass nul' : '' }}">지사대표 등록과정</a>
        <a href="{{ route('compensation') }}" class="{{ Request::routeIs('compensation') ? 'activeclass nul' : '' }}">구조 및
            보상</a>
        <a href="{{ route('install-app') }}" class="{{ Request::routeIs('install-app') ? 'activeclass nul' : '' }}">“My HUB”
            앱 설치</a>
    </div>
</div>
