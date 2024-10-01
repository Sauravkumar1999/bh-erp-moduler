@extends('layouts.landing-layout', ['title' => '자주하는 질문 (FAQ) > 고객센터'])
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ themes('css/monthlynews.css') }}">
    <link rel="stylesheet" href="{{ themes('css/faq.css') }}">
    <style>
        .table thead {
            background: linear-gradient(90deg, rgba(236, 102, 26, 0.05) 0%, rgba(236, 102, 26, 0.03) 100%);
            border-bottom: none;
        }
        .table body tr.table-row{
            border-bottom: none;
            margin: 15px !important;
        }

        .accordion-container {
            background-color: #FBFBFB
        }
        .table thead {
            border-bottom: none;
        }
        thead tr th {
            border-bottom: none !important;
        }

        .activeclass {
            color: #ec661a;
        }
        .notactiveclass {
            color: #373737;
        }

    </style>
@endpush

@section('content')
    @include('layouts.landing-below-header', ['currentPageTitle' => "고객센터 &nbsp;<img src=\"".themes('images/next-icon.png')."\">&nbsp;자주하는 질문 (FAQ)"])
    @include('layouts.landing-customer-center-dropdown-tabs')
    <div class="faq-container">
        <div class="heading">
            <h3><b>자주하는 질문 (FAQ)</b></h3>
            <div class="line">
                <img src="{{ themes('images/Line 1.png') }}">
            </div>
            <div class="faq-data-table">
                <table class="table accordion">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">내용</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $key => $faq)
                            <tr class="table-row">
                                <th scope="row">{{ $key + 1 }}</th>
                                <td class="title">{{ $faq['title'] }}</td>
                                <td onclick="toggleIcon(this)" role="button" style="cursor: pointer;"  data-bs-toggle="collapse" data-bs-target="#accordion-{{ $loop->iteration }}">
                                    <i class="fas fa-light fa-chevron-down accordion-icon activeclass" style="margin-right:10px;"></i>
                                </td>
                            </tr>
                            <tr class="collapse accordion-collapse accordion-container" id="accordion-{{ $loop->iteration }}" data-bs-parent=".table">
                                <td></td>
                                <td>{!! $faq['description'] !!}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script>
        function toggleIcon(e) {
            // Toggle the classes 'fa-chevron-up' and 'fa-chevron-down' on the first child element of e
            var current = $(e).find('>:first-child');
            current.toggleClass('fa-chevron-down fa-chevron-up');
            $(e).prev().toggleClass('activeclass notactiveclass');
            $( ".accordion-icon" ).not(current).addClass('fa-chevron-down').removeClass('fa-chevron-up');
            $( ".title" ).not($(e).prev()).addClass('notactiveclass').removeClass('activeclass');
        }
    </script>
@endpush
