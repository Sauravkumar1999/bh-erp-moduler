@extends('adminlte::page')

<style>
    .card .card-datatable .datatable-invoice tbody td span.price,
    .card .card-datatable .datatable-invoice tbody td span.date {
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        color: #6f6b7d;
    }

    .card .card-datatable .datatable-invoice tbody td span.id-text {
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        color: #EC661A;
    }

    .card .card-datatable .datatable-invoice tbody td span i {
        font-size: 20px;
    }

    .card .card-datatable div#DataTables_Table_0_filter {
        width: 150px;
    }

    .card .card-datatable div#DataTables_Table_0_filter input {
        width: 100%;
        font-size: 14px;
        padding: 7px 8px;
        margin-left: 0px;
    }
</style>
@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <div class="row">

        <!-- @widgetGroup('top-bar') -->

    </div>

    <div class="row">
        <div class="col-md-12">
            {{--            // some table widgets can be displayed here --}}
            <div class="row">
                <!-- View sales -->
                <div class="col-xl-4 mb-4 col-lg-5 col-12">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-7">
                                <div class="card-body text-nowrap">
                                    <h5 class="card-title mb-0">Congratulations John! 🎉</h5>
                                    <p class="mb-2">Best seller of the month</p>
                                    <h4 class="text-primary mb-1">$48.9k</h4>
                                    <a href="javascript:;" class="btn btn-primary">View Sales</a>
                                </div>
                            </div>
                            <div class="col-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="{{ asset('assets/img/illustrations/card-advance-sale.png') }}" height="140"
                                        alt="view sales">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- View sales -->

                <!-- Statistics -->
                <div class="col-xl-8 mb-4 col-lg-7 col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title mb-0">Statistics</h5>
                                <small class="text-muted">Updated 1 month ago</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-primary me-3 p-2"><i
                                                class="ti ti-chart-pie-2 ti-sm"></i></div>
                                        <div class="card-info">
                                            <h5 class="mb-0">230k</h5>
                                            <small>Sales</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-info me-3 p-2"><i
                                                class="ti ti-users ti-sm"></i></div>
                                        <div class="card-info">
                                            <h5 class="mb-0">8.549k</h5>
                                            <small>Customers</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-danger me-3 p-2"><i
                                                class="ti ti-shopping-cart ti-sm"></i></div>
                                        <div class="card-info">
                                            <h5 class="mb-0">1.423k</h5>
                                            <small>Products</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded-pill bg-label-success me-3 p-2"><i
                                                class="ti ti-currency-dollar ti-sm"></i></div>
                                        <div class="card-info">
                                            <h5 class="mb-0">$9745</h5>
                                            <small>Revenue</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics -->

                <div class="col-xl-4 col-12">
                    <div class="row">
                        <!-- Expenses -->
                        <div class="col-xl-6 mb-4 col-md-3 col-6">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5 class="card-title mb-0">82.5k</h5>
                                    <small class="text-muted">Expenses</small>
                                </div>
                                <div class="card-body">
                                    <div id="expensesChart"></div>
                                    <div class="mt-md-2 text-center mt-lg-3 mt-3">
                                        <small class="text-muted mt-3">$21k Expenses more than last month</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Expenses -->

                        <!-- Profit last month -->
                        <div class="col-xl-6 mb-4 col-md-3 col-6">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5 class="card-title mb-0">Profit</h5>
                                    <small class="text-muted">Last Month</small>
                                </div>
                                <div class="card-body">
                                    <div id="profitLastMonth"></div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <h4 class="mb-0">624k</h4>
                                        <small class="text-success">+8.24%</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Profit last month -->

                        <!-- Generated Leads -->
                        <div class="col-xl-12 mb-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex flex-column">
                                            <div class="card-title mb-auto">
                                                <h5 class="mb-1 text-nowrap">Generated Leads</h5>
                                                <small>Monthly Report</small>
                                            </div>
                                            <div class="chart-statistics">
                                                <h3 class="card-title mb-1">4,350</h3>
                                                <small class="text-success text-nowrap fw-medium"><i
                                                        class='ti ti-chevron-up me-1'></i> 15.8%</small>
                                            </div>
                                        </div>
                                        <div id="generatedLeadsChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Generated Leads -->
                    </div>
                </div>

                <!-- Revenue Report -->
                <div class="col-12 col-xl-8 mb-4">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row row-bordered g-0">
                                <div class="col-md-8 position-relative p-4">
                                    <div class="card-header d-inline-block p-0 text-wrap position-absolute">
                                        <h5 class="m-0 card-title">Revenue Report</h5>
                                    </div>
                                    <div id="totalRevenueChart" class="mt-n1"></div>
                                </div>
                                <div class="col-md-4 p-4">
                                    <div class="text-center mt-4">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                id="budgetId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <script>
                                                    document.write(new Date().getFullYear())
                                                </script>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="budgetId">
                                                <a class="dropdown-item prev-year1" href="javascript:void(0);">
                                                    <script>
                                                        document.write(new Date().getFullYear() - 1)
                                                    </script>
                                                </a>
                                                <a class="dropdown-item prev-year2" href="javascript:void(0);">
                                                    <script>
                                                        document.write(new Date().getFullYear() - 2)
                                                    </script>
                                                </a>
                                                <a class="dropdown-item prev-year3" href="javascript:void(0);">
                                                    <script>
                                                        document.write(new Date().getFullYear() - 3)
                                                    </script>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="text-center pt-4 mb-0">$25,825</h3>
                                    <p class="mb-4 text-center"><span class="fw-medium">Budget: </span>56,800</p>
                                    <div class="px-3">
                                        <div id="budgetChart"></div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-primary">Increase Budget</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Revenue Report -->

                <!-- Earning Reports -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Earning Reports</h5>
                                <small class="text-muted">Weekly Earnings Overview</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="earningReports" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReports">
                                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class='ti ti-chart-pie-2 ti-sm'></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Net Profit</h6>
                                            <small class="text-muted">12.4k Sales</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-3">
                                            <small>$1,619</small>
                                            <div class="d-flex align-items-center gap-1">
                                                <i class='ti ti-chevron-up text-success'></i>
                                                <small class="text-muted">18.6%</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i
                                                class='ti ti-currency-dollar ti-sm'></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Total Income</h6>
                                            <small class="text-muted">Sales, Affiliation</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-3">
                                            <small>$3,571</small>
                                            <div class="d-flex align-items-center gap-1">
                                                <i class='ti ti-chevron-up text-success'></i>
                                                <small class="text-muted">39.6%</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-secondary"><i
                                                class='ti ti-credit-card ti-sm'></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Total Expenses</h6>
                                            <small class="text-muted">ADVT, Marketing</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-3">
                                            <small>$430</small>
                                            <div class="d-flex align-items-center gap-1">
                                                <i class='ti ti-chevron-up text-success'></i>
                                                <small class="text-muted">52.8%</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div id="reportBarChart"></div>
                        </div>
                    </div>
                </div>
                <!--/ Earning Reports -->

                <!-- Popular Product -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title m-0 me-2">
                                <h5 class="m-0 me-2">Popular Products</h5>
                                <small class="text-muted">Total 10.4k Visitors</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="popularProduct" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="popularProduct">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="me-3">
                                        <img src="{{ asset('assets/img/products/iphone.png') }}" alt="User"
                                            class="rounded" width="46">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Apple iPhone 13</h6>
                                            <small class="text-muted d-block">Item: #FXZ-4567</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <p class="mb-0 fw-medium">$999.29</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="me-3">
                                        <img src="{{ asset('assets/img/products/nike-air-jordan.png') }}" alt="User"
                                            class="rounded" width="46">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Nike Air Jordan</h6>
                                            <small class="text-muted d-block">Item: #FXZ-3456</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <p class="mb-0 fw-medium">$72.40</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="me-3">
                                        <img src="{{ asset('assets/img/products/headphones.png') }}" alt="User"
                                            class="rounded" width="46">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Beats Studio 2</h6>
                                            <small class="text-muted d-block">Item: #FXZ-9485</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <p class="mb-0 fw-medium">$99</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="me-3">
                                        <img src="{{ asset('assets/img/products/apple-watch.png') }}" alt="User"
                                            class="rounded" width="46">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Apple Watch Series 7</h6>
                                            <small class="text-muted d-block">Item: #FXZ-2345</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <p class="mb-0 fw-medium">$249.99</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="me-3">
                                        <img src="{{ asset('assets/img/products/amazon-echo.png') }}" alt="User"
                                            class="rounded" width="46">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Amazon Echo Dot</h6>
                                            <small class="text-muted d-block">Item: #FXZ-8959</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <p class="mb-0 fw-medium">$79.40</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="me-3">
                                        <img src="{{ asset('assets/img/products/play-station.png') }}" alt="User"
                                            class="rounded" width="46">
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Play Station Console</h6>
                                            <small class="text-muted d-block">Item: #FXZ-7892</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <p class="mb-0 fw-medium">$129.48</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Popular Product -->

                <!-- Sales by Countries tabs-->
                <div class="col-md-6 col-xl-4 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between pb-2 mb-1">
                            <div class="card-title mb-1">
                                <h5 class="m-0 me-2">Sales by Countries</h5>
                                <small class="text-muted">62 Deliveries in Progress</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="salesByCountryTabs" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountryTabs">
                                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="nav-align-top">
                                <ul class="nav nav-tabs nav-fill" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab"
                                            data-bs-toggle="tab" data-bs-target="#navs-justified-new"
                                            aria-controls="navs-justified-new" aria-selected="true">New</button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-justified-link-preparing"
                                            aria-controls="navs-justified-link-preparing"
                                            aria-selected="false">Preparing</button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-justified-link-shipping"
                                            aria-controls="navs-justified-link-shipping"
                                            aria-selected="false">Shipping</button>
                                    </li>
                                </ul>
                                <div class="tab-content pb-0">
                                    <div class="tab-pane fade show active" id="navs-justified-new" role="tabpanel">
                                        <ul class="timeline timeline-advance timeline-advance mb-2 pb-1">
                                            <li class="timeline-item ps-4 border-left-dashed">
                                                <span class="timeline-indicator timeline-indicator-success">
                                                    <i class="ti ti-circle-check"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase fw-medium">sender</small>
                                                    </div>
                                                    <h6 class="mb-0">Myrtle Ullrich</h6>
                                                    <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA),
                                                        95959</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-4 border-transparent">
                                                <span class="timeline-indicator timeline-indicator-primary">
                                                    <i class="ti ti-map-pin"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small
                                                            class="text-primary text-uppercase fw-medium">Receiver</small>
                                                    </div>
                                                    <h6 class="mb-0">Barry Schowalter</h6>
                                                    <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                                        <ul class="timeline timeline-advance mb-0">
                                            <li class="timeline-item ps-4 border-left-dashed">
                                                <span class="timeline-indicator timeline-indicator-success">
                                                    <i class="ti ti-circle-check"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase fw-medium">sender</small>
                                                    </div>
                                                    <h6 class="mb-0">Veronica Herman</h6>
                                                    <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA),
                                                        95492</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-4 border-transparent">
                                                <span class="timeline-indicator timeline-indicator-primary">
                                                    <i class="ti ti-map-pin"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class09 May
                                                            2022="text-primary text-uppercase fw-medium">Receiver</small>
                                                    </div>
                                                    <h6 class="mb-0">Helen Jacobs</h6>
                                                    <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA),
                                                        94043</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-pane fade" id="navs-justified-link-preparing" role="tabpanel">
                                        <ul class="timeline timeline-advance mb-2 pb-1">
                                            <li class="timeline-item ps-4 border-left-dashed">
                                                <span class="timeline-indicator timeline-indicator-success">
                                                    <i class="ti ti-circle-check"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase fw-medium">sender</small>
                                                    </div>
                                                    <h6 class="mb-0">Barry Schowalter</h6>
                                                    <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-4 border-transparent">
                                                <span class="timeline-indicator timeline-indicator-primary">
                                                    <i class="ti ti-map-pin"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small
                                                            class="text-primary text-uppercase fw-medium">Receiver</small>
                                                    </div>
                                                    <h6 class="mb-0">Myrtle Ullrich</h6>
                                                    <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA),
                                                        95959 </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                                        <ul class="timeline timeline-advance mb-0">
                                            <li class="timeline-item ps-4 border-left-dashed">
                                                <span class="timeline-indicator timeline-indicator-success">
                                                    <i class="ti ti-circle-check"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase fw-medium">sender</small>
                                                    </div>
                                                    <h6 class="mb-0">Veronica Herman</h6>
                                                    <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA),
                                                        95492</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-4 border-transparent">
                                                <span class="timeline-indicator timeline-indicator-primary">
                                                    <i class="ti ti-map-pin"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small
                                                            class="text-primary text-uppercase fw-medium">Receiver</small>
                                                    </div>
                                                    <h6 class="mb-0">Helen Jacobs</h6>
                                                    <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA),
                                                        94043</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="navs-justified-link-shipping" role="tabpanel">
                                        <ul class="timeline timeline-advance mb-2 pb-1">
                                            <li class="timeline-item ps-4 border-left-dashed">
                                                <span class="timeline-indicator timeline-indicator-success">
                                                    <i class="ti ti-circle-check"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase fw-medium">sender</small>
                                                    </div>
                                                    <h6 class="mb-0">Veronica Herman</h6>
                                                    <p class="text-muted mb-0 text-nowrap">101 Boulder, California(CA),
                                                        95959</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-4 border-transparent">
                                                <span class="timeline-indicator timeline-indicator-primary">
                                                    <i class="ti ti-map-pin"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small
                                                            class="text-primary text-uppercase fw-medium">Receiver</small>
                                                    </div>
                                                    <h6 class="mb-0">Barry Schowalter</h6>
                                                    <p class="text-muted mb-0 text-nowrap">939 Orange, California(CA),92118
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="border-bottom border-bottom-dashed mt-0 mb-4"></div>
                                        <ul class="timeline timeline-advance mb-0">
                                            <li class="timeline-item ps-4 border-left-dashed">
                                                <span class="timeline-indicator timeline-indicator-success">
                                                    <i class="ti ti-circle-check"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase fw-medium">sender</small>
                                                    </div>
                                                    <h6 class="mb-0">Myrtle Ullrich</h6>
                                                    <p class="text-muted mb-0 text-nowrap">162 Windsor, California(CA),
                                                        95492 </p>
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-4 border-transparent">
                                                <span class="timeline-indicator timeline-indicator-primary">
                                                    <i class="ti ti-map-pin"></i>
                                                </span>
                                                <div class="timeline-event ps-0 pb-0">
                                                    <div class="timeline-header">
                                                        <small
                                                            class="text-primary text-uppercase fw-medium">Receiver</small>
                                                    </div>
                                                    <h6 class="mb-0">Helen Jacobs</h6>
                                                    <p class="text-muted mb-0 text-nowrap">487 Sunset, California(CA),
                                                        94043</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Sales by Countries tabs -->

                <!-- Transactions -->
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title m-0 me-2">
                                <h5 class="m-0 me-2">Transactions</h5>
                                <small class="text-muted">Total 58 Transactions done in this Month</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-3 pb-1 align-items-center">
                                    <div class="badge bg-label-primary me-3 rounded p-2">
                                        <i class="ti ti-wallet ti-sm"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Wallet</h6>
                                            <small class="text-muted d-block">Starbucks</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-danger">-$75</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3 pb-1 align-items-center">
                                    <div class="badge bg-label-success rounded me-3 p-2">
                                        <i class="ti ti-browser-check ti-sm"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Bank Transfer</h6>
                                            <small class="text-muted d-block">Add Money</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-success">+$480</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3 pb-1 align-items-center">
                                    <div class="badge bg-label-danger rounded me-3 p-2">
                                        <i class="ti ti-brand-paypal ti-sm"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Paypal</h6>
                                            <small class="text-muted d-block mb-1">Client Payment</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-success">+$268</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3 pb-1 align-items-center">
                                    <div class="badge bg-label-secondary me-3 rounded p-2">
                                        <i class="ti ti-credit-card ti-sm"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Master Card</h6>
                                            <small class="text-muted d-block mb-1">Ordered iPhone 13</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-danger">-$699</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3 pb-1 align-items-center">
                                    <div class="badge bg-label-info me-3 rounded p-2">
                                        <i class="ti ti-currency-dollar ti-sm"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Bank Transactions</h6>
                                            <small class="text-muted d-block mb-1">Refund</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-success">+$98</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-3 pb-1 align-items-center">
                                    <div class="badge bg-label-danger me-3 rounded p-2">
                                        <i class="ti ti-brand-paypal ti-sm"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Paypal</h6>
                                            <small class="text-muted d-block mb-1">Client Payment</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-success">+$126</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center">
                                    <div class="badge bg-label-success me-3 rounded p-2">
                                        <i class="ti ti-browser-check ti-sm"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Bank Transfer</h6>
                                            <small class="text-muted d-block mb-1">Pay Office Rent</small>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-danger">-$1290</h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->

                <!-- Invoice table -->
                <div class="col-xl-8">
                    <!-- <div class="card">


          <div class="table-responsive card-datatable">
            
            <table class="table datatable-invoice border-top">
              <thead>
                <tr>
                  <th></th>
                  <th>ID</th>
                  <th><i class='ti ti-trending-up text-secondary'></i></th>
                  <th>Total</th>
                  <th>Issued Date</th>
                  <th>Invoice Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
            </table>
          </div>
        </div> -->

                    <div class="card">
                        <div class="table-responsive card-datatable">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row ms-2 me-3">
                                    <div
                                        class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                                        <div class="dataTables_length" id="DataTables_Table_0_length">
                                            <label>
                                                <select name="DataTables_Table_0_length"
                                                    aria-controls="DataTables_Table_0" class="form-select">
                                                    <option value="7">7</option>
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="75">75</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div
                                            class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3">
                                            <div class="dt-buttons"><button
                                                    class="dt-button btn btn-primary waves-effect waves-light"
                                                    tabindex="0" aria-controls="DataTables_Table_0" type="button">
                                                    <span><i class="ti ti-plus me-md-2"></i>
                                                        <span class="d-md-inline-block d-none">Create Invoice</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-0 gap-md-2">
                                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                            <label>
                                                <input type="search" class="form-control" placeholder="Search Invoice"
                                                    aria-controls="DataTables_Table_0"></label>
                                        </div>
                                        <!-- <div class="invoice_status mb-3 mb-md-0">

                                </div> -->
                                        <div class="dataTables_length" id="DataTables_Table_0_length">
                                            <label>
                                                <select name="DataTables_Table_0_length"
                                                    aria-controls="DataTables_Table_0" class="form-select">
                                                    <option value="7">Select Status</option>
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="75">75</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <table class="table datatable-invoice border-top dataTable no-footer dtr-column"
                                    id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
                                    style="width: 688px;">
                                    <thead>
                                        <tr>
                                            <th class="control sorting dtr-hidden" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 17px; display: none;"
                                                aria-label=": activate to sort column ascending"></th>
                                            <th class="sorting sorting_asc" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 36px;" aria-sort="ascending"
                                                aria-label="ID: activate to sort column descending">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 45px;"
                                                aria-label=": activate to sort column ascending"><i
                                                    class="ti ti-trending-up text-secondary"></i></th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 78px;"
                                                aria-label="Total: activate to sort column ascending">Total</th>
                                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                rowspan="1" colspan="1" style="width: 144px;"
                                                aria-label="Issued Date: activate to sort column ascending">Issued Date
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                style="width: 100px;" aria-label="Actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd">
                                            <td valign="top" colspan="5" class="dataTables_empty">Loading...</td>
                                        </tr>

                                        <tr class="odd">
                                            <td>

                                                <span class="id-txt">#5089</span>
                                            </td>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <circle cx="11" cy="11" r="8.25" stroke="#A8AAAE"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M8.25 11L10.0833 12.8333L13.75 9.16666" stroke="#A8AAAE"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="price">$3077</span>
                                            </td>
                                            <td>
                                                <span class="date">09 May 2022</span>
                                            </td>
                                            <td>
                                                <div class="content-see d-flex align-items-center gap-md-3">

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22"
                                                            height="22" viewBox="0 0 22 22" fill="none">
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span><i class="ri-more-2-fill"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td>
                                                <span class="id-txt">#5089</span>
                                            </td>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <circle cx="11" cy="11" r="8.25" stroke="#A8AAAE"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M8.25 11L10.0833 12.8333L13.75 9.16666" stroke="#A8AAAE"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="price">$3077</span>
                                            </td>
                                            <td>
                                                <span class="date">09 May 2022</span>
                                            </td>
                                            <td>
                                                <div class="content-see d-flex align-items-center gap-md-3">

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22"
                                                            height="22" viewBox="0 0 22 22" fill="none">
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span><i class="ri-more-2-fill"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td>
                                                <span class="id-txt">#5089</span>
                                            </td>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <circle cx="11" cy="11" r="8.25" stroke="#28C76F"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M11 2.75V19.25" stroke="#28C76F" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M11 12.8334L17.4167 6.41669" stroke="#28C76F"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M11 17.4167L18.7917 9.625" stroke="#28C76F"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M11 8.25L15.125 4.125" stroke="#28C76F"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="price">$3077</span>
                                            </td>
                                            <td>
                                                <span class="date">09 May 2022</span>
                                            </td>
                                            <td>
                                                <div class="content-see d-flex align-items-center gap-md-3">

                                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="22"
                                                            height="22" viewBox="0 0 22 22" fill="none">
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg></span>
                                                    <span><i class="ri-more-2-fill"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td>
                                                <span class="id-txt">#5089</span>
                                            </td>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <circle cx="11" cy="11" r="8.25" stroke="#00CFE8"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M7.33333 11L11 14.6667" stroke="#00CFE8"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M11 7.33331V14.6666" stroke="#00CFE8" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M14.6667 11L11 14.6667" stroke="#00CFE8"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="price">$3077</span>
                                            </td>
                                            <td>
                                                <span class="date">09 May 2022</span>
                                            </td>
                                            <td>
                                                <div class="content-see d-flex align-items-center gap-md-3">

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22"
                                                            height="22" viewBox="0 0 22 22" fill="none">
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span><i class="ri-more-2-fill"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td>
                                                <span class="id-txt">#5089</span>
                                            </td>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <circle cx="11" cy="11" r="8.25" stroke="#EA5455"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M11 7.33331V11" stroke="#EA5455" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M10.9999 14.6666H11.0091" stroke="#EA5455"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="price">$3077</span>
                                            </td>
                                            <td>
                                                <span class="date">09 May 2022</span>
                                            </td>
                                            <td>
                                                <div class="content-see d-flex align-items-center gap-md-3">

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22"
                                                            height="22" viewBox="0 0 22 22" fill="none">
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span><i class="ri-more-2-fill"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="odd">
                                            <td>
                                                <span class="id-txt">#5089</span>
                                            </td>
                                            <td>
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <circle cx="11" cy="11" r="8.25" stroke="#A8AAAE"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M8.25 11L10.0833 12.8334L13.75 9.16669" stroke="#A8AAAE"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="price">$3077</span>
                                            </td>
                                            <td>
                                                09 May 2022
                                            </td>
                                            <td>
                                                <div class="content-see d-flex align-items-center gap-md-3">

                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="22"
                                                            height="22" viewBox="0 0 22 22" fill="none">
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <circle cx="11" cy="11" r="1.83333"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="#4B465C" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M20.1666 11C17.7219 15.2781 14.6666 17.4166 11 17.4166C7.33331 17.4166 4.27806 15.2781 1.83331 11C4.27806 6.7219 7.33331 4.58331 11 4.58331C14.6666 4.58331 17.7219 6.7219 20.1666 11"
                                                                stroke="white" stroke-opacity="0.2" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </span>
                                                    <span><i class="ri-more-2-fill"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row d-flex align-items-center mx-2">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                            aria-live="polite">Showing 0 to 0 of 0 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 mt-1">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="DataTables_Table_0_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="DataTables_Table_0_previous">
                                                    <a aria-controls="DataTables_Table_0" aria-disabled="true"
                                                        role="link" data-dt-idx="previous" tabindex="0"
                                                        class="page-link">Previous</a>
                                                </li>
                                                <li class="paginate_button page-item next disabled"
                                                    id="DataTables_Table_0_next">
                                                    <a aria-controls="DataTables_Table_0" aria-disabled="true"
                                                        role="link" data-dt-idx="next" tabindex="0"
                                                        class="page-link">Next</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice table -->
            </div>

        </div>
    </div>

@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('vendor/vuexy/js/dashboards-analytics.js') }}"></script>

    <script src="{{ asset('vendor/vuexy/js/app-ecommerce-dashboard.js') }}"></script>
@stop
