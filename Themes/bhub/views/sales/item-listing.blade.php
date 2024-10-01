@extends('layouts.landing-layout', ['title' => '세일즈 아이템'])
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css"
        integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/salesitems.css') }}">
    <style>
        /* custom-card-css-start */

        .cus__card {
            width: 100%;
            border-top: 5px solid #EC661A;
            position: relative;
            box-shadow: 0px 4px 8px 0px #00000014;
            height: 100%;
        }

        .cus__card .cus__card__image {
            width: 100%;
            /*height: 157px;*/
        }

        .cus__card .cus__card__image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 0 !important;
        }

        .cus__card .cus__card__body {
            padding: 5px 20px;
        }

        .cus__card .cus__card__body .cus__card__title {
            font-family: Pretendard;
            font-size: 24px;
            font-weight: 700;
            line-height: 28.64px;
            text-align: left;
            color: #EC661A;
            margin: 0 0 12px;
        }

        .cus__card .cus__card__body .cus__card__text {
            font-family: Pretendard;
            font-size: 18px;
            font-weight: 400;
            line-height: 24px;
            text-align: left;
            color: #373737;
            margin: 0;
        }

        .card_set {
            position: relative;
        }

        .cus__card .share__icon button {
            position: absolute;
            right: 12px;
        }

        @media(max-width:640px) {
            .cus__card .cus__card__image {
                height: fit-content;
            }

            .cus__card .share__icon button {
                top: -6px;
            }

            .row .col-12 .cus__card__text {
                padding: 0px 15px 15px;
                font-size: 12px;
                font-weight: 400;
                line-height: 18px;
            }

            .cus__card .cus__card__body {
                padding: 5px 15px;
            }

            .cus__card .cus__card__body .cus__card__title {
                font-size: 14px !important;
                line-height: 16.71px !important;
                font-weight: 700 !important;
            }

            .cus__card .cus__card__body .cus__card__text {
                font-size: 11px !important;
                line-height: 13px !important;
            }

            .cards-container {
                width: 95% !important;
            }

            .cus__card .share__icon {
                top: 98px;
            }
        }

        @media(max-width:375px) {
            .cus__card .share__icon {
                top: 86px;
            }
        }

        @media(max-width:320px) {
            .cus__card .share__icon {
                top: 77px;
            }
        }

        .page-load-status {
            display: none;
            /* hidden by default */
            padding-top: 20px;
            border-top: 1px solid #DDD;
            text-align: center;
            color: #777;
        }
        .rental-mall-card-title{
            margin: 0 auto !important;
            padding-left: 0;
            padding-right: 0;
        }
        /* loader ellips in separate pen CSS */
    </style>
@endpush
@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => '세일즈 아이템'])
    <div class="main-container">
        <div class="main-heading">
            <div class="d-none d-md-block">
                <h4><b>세일즈 아이템들을, 내 홈페이지에서, 내 스타일대로 배열한다.</b></h4>
            </div>
            <div class="d-block d-md-none">
                <h4><b>세일즈 아이템들을, <br />내 홈페이지에서, <br />내 스타일대로 배열한다.</b></h4>
            </div>
            <div class="line">
                <img src="{{ themes('images/line-1.png') }}">
            </div>
        </div>
        <div class="container pt-1">
            <div class="row gy-3 gx-2 p-md-5" id="product-container">
            </div>
            <div class="ajax-load text-center" style="display:none">
                <div class="spinner-border text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/vuexy/vendor/libs/clipboard/clipboard.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy/js/ui-popover.js') }}"></script>
    {{-- <script src="{{ themes('js/jquery.waypoints.min.js') }}"></script> --}}
    {{-- <script src="{{ themes('js/jquery.waypoints.min.js') }}"></script> --}}
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.js"></script>
    {{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>  --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> --}}



    <script>
        function showInformationAlert() {
            Swal.fire({
                html: "현재 세일즈 아이템 접근 권한이 없습니다." +
                    "<br>권한 해제를 원하시는 지사대표(Biz Planner)님들은" +
                    "<br>본사({{ setting('bh_telephone', '') }})로 전화 신청해 주세요",
                icon: "info"
            });
        }

        function copyToClipboard(button) {
            const clipboardItem = new ClipboardJS('.clipboard-copy-item');
            $('.clipboard-copy-item').on('click', function(e) {
                e.preventDefault();
                // Initialize Popper with placement at the top
                // Show Bootstrap tooltip
                $(this).tooltip({
                    title: '주소가 복사되었습니다.',
                    placement: 'top',
                    trigger: 'manual'
                });

                // Show tooltip
                $(this).tooltip('show');
                setTimeout(function() {
                    $('.clipboard-copy-item').tooltip('hide');
                }, 1000);
            });
        }
        @if (setting('rental_mall_enabled', 1))
        $( document ).ready(function() {
            $(document).on('click','.rental_mall_card',function(e){
                e.preventDefault();
                Swal.fire({
                    title: "{{trans('sale::sale.rental-mall-services-text')}}",
                    icon: "info",
                    customClass: {
                        title: 'rental-mall-card-title',
                        confirmButton: 'btn btn-primary waves-effect waves-light rental-mall-card-btn',
                    }
                });
                return;
            })
        });
        @endif
    </script>


    <script>
        let pages = 2;
        let current_page = 0;
        let bool = false;
        let lastPage;
        $(window).scroll(function() {
            let height = $(document).height();
            var threshold = 200;
            // Calculate the distance from the bottom of the document
            var distanceFromBottom = $(document).height() - ($(window).scrollTop() + $(window).height());
            // Check if the distance from the bottom is within the threshold
            if (distanceFromBottom <= threshold && bool == false && lastPage > pages - 2) {

                bool = true;
                $('.ajax-load').show();
                lazyLoad(pages)
                    .then(() => {
                        bool = false;
                        pages++;
                        // if (pages - 2 == lastPage) {
                        //     $('.no-data').show();
                        // }
                    })
            }
        })

        function lazyLoad(page) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ route('sales.products.receive.init') }}" + '?page=' + page,
                    type: 'GET',
                    beforeSend: function() {
                        $('.ajax-load').show();
                    },
                    success: function(response) {
                        $('.ajax-load').hide();
                        let html = '';

                        var products = response.data.data;

                        products.forEach(product => {
                            var banner = '#';
                           // if (product.media[0]) {
                            //    banner = "{{ route('media.file.display', ['filename' => ':key']) }}";
                            //    banner = banner.replace(':key', product.media[0].filename +
                             //       '.' + product.media[0].extension);
                           // }

                            if (product.banner) {
                                banner = '{{ route('media.file.display', ['filename' => ':key']) }}';
                                banner = banner.replace(':key', product.banner)
                            }

                            html += `<div class="col-md-4 col-sm-6 col-6">
                                <div class="cus__card">
                                    <a href="${ product.url_1 ? product.url_1 : '#' }" class="text-decoration-none ${(product.product_name == '렌탈몰') ? 'rental_mall_card' : ''}">
                                        <div class="cus__card__image">
                                            <img src="${banner}" onerror="this.src='../images/no-image.png';"
                                                class="card-img-top" alt="...">
                                        </div>
                                        <div class="row card_set">
                                            <div class="col-12">
                                                <div class="row justify-content-between">
                                                    <div class="col-10 col-md-11">
                                                        <div class="cus__card__body">
                                                            <h4 class="cus__card__title">${ product.product_name }</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-1 text-right">
                                                        <div class="share__icon">
                                                            <button type="button" class="btn clipboard-copy-item"
                                                                data-clipboard-text="${ product.url_1 ? product.url_1 : '#' }" data-bs-toggle="tooltip"
                                                                data-bs-placement="bottom" data-bs-title="주소가 복사되었습니다." data-bs-trigger="click">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-light"
                                                                    viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M18 16.12C17.24 16.12 16.56 16.42 16.04 16.89L8.91 12.74C8.96 12.51 9 12.28 9 12.04C9 11.8 8.96 11.57 8.91 11.34L15.96 7.22998C16.5 7.72998 17.21 8.03998 18 8.03998C19.66 8.03998 21 6.69998 21 5.03998C21 3.37998 19.66 2.03998 18 2.03998C16.34 2.03998 15 3.37998 15 5.03998C15 5.27998 15.04 5.50998 15.09 5.73998L8.04 9.84998C7.5 9.34998 6.79 9.03998 6 9.03998C4.34 9.03998 3 10.38 3 12.04C3 13.7 4.34 15.04 6 15.04C6.79 15.04 7.5 14.73 8.04 14.23L15.16 18.39C15.11 18.6 15.08 18.82 15.08 19.04C15.08 20.65 16.39 21.96 18 21.96C19.61 21.96 20.92 20.65 20.92 19.04C20.92 17.43 19.61 16.12 18 16.12Z"
                                                                        fill="#666666" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="cus__card__text">${ product.product_description }</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>`
                        });
                        $('#product-container').append(html);
                        resolve();
                    }
                });
            })
        }
        loadData(1);

        function loadData(page) {
            $.ajax({
                url: "{{ route('sales.products.receive.init') }}" + '?page=' + page,
                type: 'GET',
                beforeSend: function() {
                    $('.ajax-load').show();
                },
                success: function(response) {
                    $('.ajax-load').hide();
                    lastPage = response.data.last_page;
                    let html = '';
                    var products = response.data.data;

                    products.forEach(product => {
                        var banner = '#';
                       // if (product.media[0]) {
                        //    banner = "{{ route('media.file.display', ['filename' => ':key']) }}";
                        //    banner = banner.replace(':key', product.media[0].filename + '.' + product
                        //        .media[0].extension);
                       // }

                        if (product.banner) {
                            banner = '{{ route('media.file.display', ['filename' => ':key']) }}';
                            banner = banner.replace(':key', product.banner)
                        }


                        html += `<div class="col-md-4 col-sm-6 col-6">
                        <div class="cus__card">
                            <a href="${ product.url_1 }" class="text-decoration-none ${(product.product_name == '렌탈몰') ? 'rental_mall_card' : ''}">
                                <div class="cus__card__image">
                                    <img src="${banner}" onerror="this.src='../images/no-image.png';"
                                        class="card-img-top" alt="...">
                                </div>
                                <div class="row card_set">
                                    <div class="col-12">
                                        <div class="row justify-content-between">
                                            <div class="col-10 col-md-11">
                                                <div class="cus__card__body">
                                                    <h4 class="cus__card__title">${ product.product_name }</h4>
                                                </div>
                                            </div>
                                            <div class="col-1 text-right">
                                                <div class="share__icon">
                                                    <button type="button" class="btn clipboard-copy-item"
                                                        onclick="copyToClipboard(this); return false;"
                                                        data-clipboard-text="${ product.url_1 ? product.url_1 : '#' }" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="주소가 복사되었습니다." data-bs-trigger="click">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-light"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M18 16.12C17.24 16.12 16.56 16.42 16.04 16.89L8.91 12.74C8.96 12.51 9 12.28 9 12.04C9 11.8 8.96 11.57 8.91 11.34L15.96 7.22998C16.5 7.72998 17.21 8.03998 18 8.03998C19.66 8.03998 21 6.69998 21 5.03998C21 3.37998 19.66 2.03998 18 2.03998C16.34 2.03998 15 3.37998 15 5.03998C15 5.27998 15.04 5.50998 15.09 5.73998L8.04 9.84998C7.5 9.34998 6.79 9.03998 6 9.03998C4.34 9.03998 3 10.38 3 12.04C3 13.7 4.34 15.04 6 15.04C6.79 15.04 7.5 14.73 8.04 14.23L15.16 18.39C15.11 18.6 15.08 18.82 15.08 19.04C15.08 20.65 16.39 21.96 18 21.96C19.61 21.96 20.92 20.65 20.92 19.04C20.92 17.43 19.61 16.12 18 16.12Z"
                                                                fill="#666666" />
                                                        </svg>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="cus__card__text">${ product.product_description }</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>`
                    });
                    $('#product-container').html(html);
                }
            });
        }
    </script>
@endpush
