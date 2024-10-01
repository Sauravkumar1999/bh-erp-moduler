@extends('layouts.landing-layout', ['title' => '월간뉴스 > 고객센터'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/monthlynews.css') }}">
@endpush

@section('content')
@include('layouts.landing-below-header', ['currentPageTitle' => "고객센터 &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;월간뉴스"])
    @include('layouts.landing-customer-center-dropdown-tabs')
    <div class="monthly-news-container">
        <div class="heading">
            <h3><b>월간뉴스</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
            <div class="sub-heading">
                <h5><b>
                        < {{date('Y')}}년 {{date('m')}}월 뉴스 >
                    </b></h5>
            </div>
            <div class="main-picture">
                {{-- <img src="{{ themes('images/monthly-img.png') }}"  alt="image"> --}}

                @php

                    $monthly_news_img = themes('images/monthly-img.png');

                    if(setting('monthly-news-img')) {
                        $monthly_news_img = route('media.file.display', ['filename' => setting('monthly-news-img')]);
                    }

                @endphp

                <img src="{{ $monthly_news_img }}" alt="image" width="60%" style="margin: 0px auto;">
            </div>
            <div class="monthly-data-table">
                <table class="table">
                    <tr class="bg-colored-row">
                        <th>No</th>
                        <th>내용</th>
                        <th>형태</th>
                        <th>게시일자</th>
                    </tr>
                    @foreach ($monthly_news as $news)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $news->detail }}</td>
                            <td>{{ $news->form }}</td>
                            <td>{{ $news->posting_date }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @push('scripts')

        @endpush
@endsection
