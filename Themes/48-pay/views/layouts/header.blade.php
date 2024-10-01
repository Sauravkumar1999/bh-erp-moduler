    <div class="button-container">
        <div class="button-sub-container">
            {{-- <div class="col-md-10"> --}}
            {{-- <div class="row align-items-center justify-content-between"> --}}
            {{-- <div class="col-md-4 col-12">
                    <img src="{{ themes('images/48pay-logo.png') }}" alt="48pay-logo" class="img-fluid">
                </div> --}}
            {{-- <div class="col-md-5 col-12 ">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="navbar-nav" style="gap: 16px">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(3) === 'plan' ? '' : 'text-dark' }}"@if (Request::segment(3) === 'plan') style="color: rgba(253, 111, 34, 1)" @endif
                                        href="{{ route('48-pay.installment.plan')}}">48개월
                                        초슬림할부</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(3) === 'payment' ? '' : 'text-dark' }}"@if (Request::segment(3) === 'payment') style="color: rgba(253, 111, 34, 1)" @endif
                                        href="{{ route('48-pay.installment.payment')}}">결제 구조</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(3) === 'merchant' ? '' : 'text-dark' }}"@if (Request::segment(3) === 'merchant') style="color: rgba(253, 111, 34, 1)" @endif
                                        href="{{ route('merchant.view')}}">가맹 절차</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-3 col-12 gap-1">
                    <div class="float-end">
                        <button type="button" class="btn btn-sm px-3 btn-outline"
                            style="border-color: rgba(253, 111, 34, 1); color: rgba(253, 111, 34, 1)">가맹 상담 신청</button>
                        {{-- <button type="button" class="btn btn-sm px-3 btn-outline"
                            style="border-color: rgba(253, 111, 34, 1); color: rgba(253, 111, 34, 1)">가맹 도우미</button>
                    </div>
                </div> --}}


            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid m-md-0 mx-3 my-2">
                    <a class="navbar-brand" href="#"><img src="{{ themes('images/48pay-logo.png') }}" alt="48pay-logo"
                            class="img-fluid"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(3) === 'plan' ? '' : 'text-dark' }}" @if(Request::segment(3) === 'plan') style="color: rgba(253, 111, 34, 1)" @endif
                                    href="{{ route('48-pay.installment.plan') }}">48개월 초슬림할부</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(3) === 'payment' ? '' : 'text-dark' }}" @if(Request::segment(3) === 'payment') style="color: rgba(253, 111, 34, 1)" @endif
                                    href="{{ route('48-pay.installment.payment') }}">결제 구조</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(3) === 'merchant' ? '' : 'text-dark' }}" @if(Request::segment(3) === 'merchant') style="color: rgba(253, 111, 34, 1)" @endif
                                    href="{{ route('48-pay.merchant.view') }}">가맹 절차</a>
                            </li>
                        </ul>
                        <a href="{{ $inquiry_form_link ?? '' }}" class="btn btn-sm px-3 btn-outline d-none d-md-none"
                            style="border-color: rgba(253, 111, 34, 1); color: rgba(253, 111, 34, 1)">가맹 상담 신청</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="subnav d-none d-md-none">
        <a href="{{ route('48-pay.merchant.view') }}">
            <button type="button" class="btn btn-sm px-3 btn-outline" style="border-color: rgba(253, 111, 34, 1); color: rgba(253, 111, 34, 1)">가맹 상담 신청</button>
        </a>
    </div>
