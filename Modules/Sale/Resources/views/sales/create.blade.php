@extends('adminlte::page')

@section('title', __('sale::sale.sales-management'))

@section('content_header')
    <div class="d-flex align-content-center">
        <a href="{{ route('admin.sales.index') }}" class="link-primary mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M15 6.5L9 12.5L15 18.5" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <x-core-content-header :title="@lang('sale::sale.sales-management')" :breadcrumbs="$breadcrumbs" />
    </div>

@stop

@section('content')

    <x-adminlte-card theme="primary" theme-mode="outline">
        <form autocomplete="off" method="POST" action="{{ route('admin.sales.store') }}">
            @csrf
            <div class="form-group mb-4 ">
                <label for="product_sale_day" class="form-label">{{ trans('sale::sale.product-sale-date') }}</label>
                <input id="product_sale_day" type="text" name="product_sale_day" value="{{ old('product_sale_day') }}"
                    class="form-control calendar @error('product_sale_day') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.select-date') }}">
                @error('product_sale_day')
                    <div class="invalid-feedback">{{ trans('sale::sale.product-sale-date-required') }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="product_id" class="form-label">{{ trans('sale::sale.product-name') }}</label>
                <select id="product_id" name="product_id" data-placeholder="{{ trans('sale::sale.product-name') }}"
                    class="form-select bh-select2 @error('product_id') is-invalid @enderror">
                    <option selected>{{ trans('sale::sale.select-product') }}</option>
                    @foreach ($products as $product)
                    @php
                        if($product->company->status != 1) continue;
                    @endphp
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                    <div class="invalid-feedback">{{ trans('sale::sale.product-required') }}</div>
                @enderror
            </div>

            <div class="form-group mb-4 ">
                <label for="company_id" class="form-label">{{ trans('sale::sale.company-name') }}</label>
                <input id="company_id" type="text" name="company_id" value="{{ old('company_id') }}"
                    class="form-control read-only @error('company_id') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.company-name') }}" readonly>
                @error('company_id')
                    <div class="invalid-feedback">{{ trans('sale::sale.company-required') }}</div>
                @enderror
            </div>
            <div class="form-group mb-4 ">
                <label for="product_code" class="form-label">{{ trans('sale::sale.product-code') }}</label>
                <input id="product_code" type="text" name="product_code" value="{{ old('product_code') }}"
                    class="form-control read-only @error('product_code') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.product-code') }}" readonly>
                @error('product_code')
                    <div class="invalid-feedback">{{ trans('sale::sale.product-code-required') }}</div>
                @enderror
            </div>

            <div class="form-group mb-4 ">
                <label for="fee_type" class="form-label">{{ trans('sale::sale.fee-type') }}</label>
                <input id="fee_type" type="text" name="fee_type" value="{{ old('fee_type') }}"
                    class="form-control read-only @error('fee_type') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.fee-type') }}" readonly>
                @error('fee_type')
                    <div class="invalid-feedback">{{ trans('sale::sale.fee-type-required') }}</div>
                @enderror
            </div>

            <div class="form-group mb-4 ">
                <label for="product_price" class="form-label">{{ trans('sale::sale.product-price') }}</label>
                <input id="product_price" type="text" name="product_price" value="{{ old('product_price') }}"
                    class="form-control read-only @error('product_price') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.fee-type') }}" readonly>
                @error('product_price')
                    <div class="invalid-feedback">{{ trans('sale::sale.product-price-required') }}</div>
                @enderror
            </div>
            <div class="form-group mb-4 ">
                <label for="remark" class="form-label">{{ trans('sale::sale.remark') }}</label>
                <textarea id="remark" name="remark" value="{{ old('remark') }}" class="form-control"
                    placeholder="{{ trans('sale::sale.enter-remark') }}">{{ old('remark') }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="seller_id" class="form-label">{{ trans('sale::sale.seller-name') }}</label>
                <select id="seller_id" name="seller_id" data-placeholder="담당자 선택"
                    class="form-select bh-select2 @error('seller_id') is-invalid @enderror">
                    <option selected>{{ trans('sale::sale.select-seller') }}</option>
                    @foreach ($users as $seller)
                        <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>
                            {!! $seller->first_name .
                                ' ' .
                                $seller->last_name .
                                '<span class="bg-secondary">( ' .
                                $seller->code .
                                ' )</span>' !!}</option>
                    @endforeach
                </select>
                @error('seller_id')
                    <div class="invalid-feedback">{{ trans('sale::sale.seller-required') }}</div>
                @enderror
            </div>

            <div class="mt-2">
                <div class="form-group mb-4 ">
                    <label for="sales_type">{{ trans('sale::sale.sale-price') }}</label>
                    <input id="sales_price" type="text" name="sales_price" value="{{ old('sales_price') }}"
                        class="form-control inputmask @error('sales_price') is-invalid @enderror"
                        placeholder="{{ trans('sale::sale.enter-sale-price') }}">
                    @error('sales_price')
                        <div class="invalid-feedback">{{ trans('sale::sale.sales-price-required') }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-4 ">
                <label for="number_of_sales" class="form-label">{{ trans('sale::sale.number-of-sales') }}</label>
                <input id="number_of_sales" type="text" name="number_of_sales" value="{{ old('number_of_sales') }}"
                    class="form-control inputmask @error('number_of_sales') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.enter-number-of-sales') }}">
                @error('number_of_sales')
                    <div class="invalid-feedback">{{ trans('sale::sale.number-of-sales-required') }}</div>
                @enderror
            </div>

            <div class="form-group mb-4 ">
                <label for="take" class="form-label">{{ trans('sale::sale.take') }}</label>
                <input id="take" type="text" name="take" value="{{ old('take') }}"
                    class="form-control inputmask @error('take') is-invalid @enderror read-only readonly"
                    placeholder="{{ trans('sale::sale.take') }}" readonly>
                @error('take')
                    <div class="invalid-feedback">{{ trans('sale::sale.take-required') }}</div>
                @enderror
            </div>

            <div class="form-group mb-4 ">
                <label for="sales_information" class="form-label">{{ trans('sale::sale.sales-information') }}</label>
                <textarea id="sales_information" name="sales_information" value="{{ old('sales_information') }}"
                    class="form-control @error('sales_information') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.enter-sales-information') }}">{{ old('sales_information') }}</textarea>
                @error('sales_information')
                    <div class="invalid-feedback">{{ trans('sale::sale.sales-information-required') }}</div>
                @enderror
            </div>

            <!--div class="form-group mb-4 ">
                    <label for="bh_operating_income" class="form-label">{{ trans('sale::sale.bh-operating-income') }}</label>
                    <input id="bh_operating_income" type="text" name="bh_operating_income"
                        value="{{ old('bh_operating_income') }}"
                        class="form-control inputmask read-only readonly commission_charges @error('bh_operating_income') is-invalid @enderror"
                        placeholder="{{ trans('sale::sale.enter-number') }}" readonly>
                    @error('bh_operating_income')
        <div class="invalid-feedback">{{ trans('sale::sale.bh-operating-income-required') }}</div>
    @enderror
                </div-->
            <div class="mt-2">
                <label for="comissions" class="h6">
                    {{ trans('sale::sale.commissions') }}
                    <span data-bs-toggle="popover" class="badge badge-center rounded-pill bg-label-secondary cursor-pointer"
                        data-bs-placement="top" data-bs-content="Sales commission">
                        <i class="fa-regular fa-question"></i>
                    </span>
                </label>
                <div class="row">
                    <div class="col-md-3 col-form-label text-nowrap">
                        <label for="">{{ trans('sale::sale.branch-representative') }}</label>
                    </div>
                    <div class="col-9">
                        <div class="form-group mb-4 ">
                            <input id="branch_representative" type="text" name="branch_representative"
                                value="{{ old('branch_representative') }}"
                                class="form-control inputmask read-only readonly commission_charges @error('branch_representative') is-invalid @enderror"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 col-form-label text-nowrap">
                        <label for="">{{ trans('sale::sale.branch-agent') }}</label>
                    </div>
                    <div class="col-10">
                        <div class="form-group mb-4 ">
                            <input id="branch_agent" type="text" name="branch_agent"
                                value="{{ old('branch_agent') }}"
                                class="form-control inputmask read-only readonly commission_charges @error('branch_agent') is-invalid @enderror"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 col-form-label">
                        <label for="">{{ trans('sale::sale.managing-director') }}</label>
                    </div>
                    <div class="col-10">
                        <div class="form-group mb-4 ">
                            <input id="managing_director" type="text" name="managing_director_normal"
                                value="{{ old('managing_director_normal') }}"
                                class="form-control inputmask read-only readonly commission_charges @error('managing_director_normal') is-invalid @enderror"
                                readonly>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-2 col-form-label">
                        <label for="">{{ trans('sale::sale.principal-managing-director') }}</label>
                    </div>
                    <div class="col-10">
                        <div class="form-group mb-4 ">
                            <input id="principal_managing_director" type="text"
                                name="principal_managing_director_normal"
                                value="{{ old('principal_managing_director_normal') }}"
                                class="form-control inputmask read-only readonly commission_charges @error('principal_managing_director_normal') is-invalid @enderror"
                                readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <label for="comissions"
                    class="h6">{{ trans('sale::sale.headquarters-representative-allowance') }}</label>
                <div class="row">
                    <div class="col-md-2 col-form-label">
                        <label for="">{{ trans('sale::sale.managing-director') }}</label>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group mb-4 ">
                            <input id="md" type="text" name="managing_director_head"
                                value="{{ old('managing_director_head') }}"
                                class="form-control inputmask read-only readonly commission_charges @error('managing_director_head') is-invalid @enderror"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-2 col-form-label">
                        <label for="">{{ trans('sale::sale.principal-managing-director') }}</label>
                    </div>
                    <div class="col-10">
                        <div class="form-group mb-4 ">
                            <input id="pmd" type="text" name="principal_managing_director_head"
                                value="{{ old('principal_managing_director_head') }}"
                                class="form-control inputmask read-only readonly commission_charges @error('principal_managing_director_head') is-invalid @enderror"
                                readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4 ">
                <label for="referral_bonus" class="form-label">{{ trans('sale::sale.referral-bonus') }}</label>
                <input id="referral_bonus" type="text" name="referral_bonus" value="{{ old('referral_bonus') }}"
                    class="form-control read-only inputmask readonly commission_charges @error('referral_bonus') is-invalid @enderror"
                    readonly>
            </div>

            @php
                $refUserId = '';
                $refUserName = '';

                $refUser = get_referral_user(auth()->id());

                if($refUser) {
                    $refUserId = $refUser->id;
                    $refUserName = $refUser->full_name.'('.$refUser->code.')';
                }
            @endphp


            <div class="form-group mb-4 ">
                <label for="referral_bonus_recipients"
                    class="form-label">{{ trans('sale::sale.referral-bonus-recipients') }}</label>
                <input id="referral_bonus_recipients" type="text" name="referral_bonus_recipients"
                    value="{{ $refUserName }}"
                    class="form-control read-only readonly"
                    readonly>
                <input type="hidden" name="referral_bonus_recipient_id" value="{{ $refUserId }}" />
            </div>

            <div class="form-group mb-4 ">
                <label for="other_fees" class="form-label">{{ trans('sale::sale.other-fees') }}</label>
                <input id="other_fees" type="text" name="other_fees" value="{{ old('other_fees') }}"
                    placeholder="{{ trans('sale::sale.enter-number') }}"
                    class="form-control read-only inputmask readonly @error('other_fees') is-invalid @enderror" readonly>
            </div>


            <div class="form-group mb-4 ">
                <label for="other_fees_reasons" class="form-label">{{ trans('sale::sale.other-fees-reasons') }}</label>
                <textarea id="other_fees_reasons" name="other_fees_reasons" value="{{ old('other_fees_reasons') }}"
                    class="form-control @error('other_fees_reasons') is-invalid @enderror"
                    placeholder="{{ trans('sale::sale.other-fees-content') }}">{{ old('other_fees_reasons') }}</textarea>
                @error('other_fees_reasons')
                    <div class="invalid-feedback">{{ trans('sale::sale.other-fees-reasons-required') }}</div>
                @enderror
            </div>

            <!--div class="form-group mb-4 ">
                    <label for="operating_income" class="form-label">{{ trans('sale::sale.operating-income') }}</label>
                    <input id="operating_income" type="text" name="operating_income"
                        value="{{ old('operating_income') }}"
                        class="form-control inputmask @error('operating_income') is-invalid @enderror"
                        placeholder="{{ trans('sale::sale.enter-operating-income') }}">
                    @error('operating_income')
        <div class="invalid-feedback">{{ trans('sale::sale.operating-income-required') }}</div>
    @enderror
                </div-->

            <!--div class="mt-2">
                    <label for="sales_status">{{ trans('sale::sale.sale-status') }}</label>
                    <div class="my-2">
                        <input class="form-check-input" type="radio" name="sales_status" id="status_proceeding"
                            value="proceeding"
                            {{ old('sales_status') == 'proceeding' || !old('sales_status') ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_proceeding">{{ trans('sale::sale.proceeding') }}</label>
                        <input class="form-check-input" type="radio" name="sales_status" id="status_confirmed"
                            value="confirmed" {{ old('sales_status') == 'confirmed' ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_confirmed">{{ trans('sale::sale.confirmed') }}</label>
                        <input class="form-check-input" type="radio" name="sales_status" id="status_cancellation"
                            value="cancellation" {{ old('sales_status') == 'cancellation' ? 'checked' : '' }}>
                        <label class="form-check-label"
                            for="status_cancellation">{{ trans('sale::sale.cancellation') }}</label>
                        <input class="form-check-input" type="radio" name="sales_status" id="status_refund"
                            value="refund" {{ old('sales_status') == 'refund' ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_refund">{{ trans('sale::sale.refund') }}</label>
                    </div>
                    @error('sales_status')
        <div class="invalid-feedback d-block">{{ trans('sale::sale.sales-status-required') }}</div>
    @enderror
                </div-->

            <div class="form-group mt-3">
                <div class="form-group mb-4 ">
                    <label for="current_user">{{ trans('sale::sale.created-by') }}</label>
                    <input id="current_user" type="text" name="current_user"
                        value="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name . '(' . auth()->user()->code . ')' }}"
                        class="form-control read-only readonly" readonly>
                </div>

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
            </div>
            <div class="float-right my-4">
                <button type="submit" class="btn btn-primary">{{ trans('sale::sale.submit') }}</button>
            </div>
        </form>


    </x-adminlte-card>
    <!-- Include the Livewire component -->

@endsection

@section('css')
    <style>
        .readonly input {
            background-color: #f2f2f2;
        }

        .user-tabel-heading {
            color: #2B2B2B;
            font-size: 18px;
            font-weight: 500;
        }

        .form-select {
            color: #2B2B2B;
        }

        .form-select::placeholder {
            color: #DBDADE
        }

        div#user-table_wrapper .row:last-child {
            justify-content: center;
        }

        div#user-table_wrapper .row:last-child .pagination {
            justify-content: center;
        }

        table#user-table {
            color: var(--txt, #2B2B2B);
            font-feature-settings: 'clig' off, 'liga' off;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: normal;
        }

        table#user-table thead tr th {
            border: -top 1px solid #DBDADE;
            border: -bottom 1px solid #DBDADE;
            background: rgba(236, 102, 26, 0.07);
        }

        .DTE_Field label {
            width: 100% !important;
            color: #2B2B2B !important;
            padding-bottom: 5px !important;
        }

        /* .DTE_Field div {
                                                                                                                                                                                                                                                                                                                                                                width: 100% !important;
                                                                                                                                                                                                                                                                                                                                                            } */
        div.DTE div.editor_upload div.cell {
            display: table-cell;
            position: relative;
            width: 100% !important;
            vertical-align: top;
        }

        div[data-dte-e="input"] {
            width: 100%;
        }

        .DTE_Field_InputControl div {
            display: flex;
        }

        #DTE_Field_gender_1 {
            margin-left: 10px;
        }

        .DTE_Body.modal-body {
            padding: 30px 60px;
        }

        .DTE_Header_Content {
            margin: auto;
        }

        .DTE_Header_Content h5 {
            font-size: 26px;
            font-weight: 500;
            line-height: 36px;
            text-align: center;
            margin-top: 20px;
            color: #2B2B2B;
        }

        .form-check-input:checked {
            background-color: #EC661A !important;
            border-color: #EC661A !important;
        }

        .DTE_Field_Name_gender div {
            width: 70% !important;
        }

        .DTE_Form_Buttons button {
            color: #fff !important;
            background-color: #EC661A !important;
            border-color: #EC661A !important;
        }

        .DTE_Field input {
            border: 1px solid #DBDADE;
        }

        .DTE_Body::-webkit-scrollbar {
            width: 4px !important;
        }

        .DTE_Body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .DTE_Body::-webkit-scrollbar-thumb {
            background: #EC661A;
        }


        .table#user-table {
            white-space: nowrap;
        }

        .datepicker {
            margin: 80px auto;
            width: 400px;
            height: 320px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            font-family: 'Roboto';
            border-radius: 8px 8px 0px 0px;
            background-color: white;
            padding: 0px !important;
        }

        .datepicker .datepicker-days table,
        .datepicker .datepicker-months table,
        .datepicker .datepicker-years table,
        .datepicker .datepicker-decades table,
        .datepicker .datepicker-centuries table {
            width: 100%;
            height: 100%;
        }

        .datepicker .datepicker-days table th,
        .datepicker .datepicker-months table th,
        .datepicker .datepicker-years table th,
        .datepicker .datepicker-decades table th,
        .datepicker .datepicker-centuries table th {
            background-color: #EC661A;
            height: 45px;
            border-radius: 0px !important;
        }

        .datepicker .datepicker-days table th.prev,
        .datepicker .datepicker-days table th.datepicker-switch,
        .datepicker .datepicker-days table th.next,
        .datepicker .datepicker-months table th.prev,
        .datepicker .datepicker-months table th.datepicker-switch,
        .datepicker .datepicker-months table th.next,
        .datepicker .datepicker-years table th.prev,
        .datepicker .datepicker-years table th.datepicker-switch,
        .datepicker .datepicker-years table th.next,
        .datepicker .datepicker-decades table th.prev,
        .datepicker .datepicker-decades table th.datepicker-switch,
        .datepicker .datepicker-decades table th.next,
        .datepicker .datepicker-centuries table th.prev,
        .datepicker .datepicker-centuries table th.datepicker-switch,
        .datepicker .datepicker-centuries table th.next {
            color: #fff;
            font-weight: 600;
            font-size: 18px;
        }

        .datepicker .datepicker-days table th.dow {
            color: #fff;
            font-weight: 600;
            font-size: 16px;
        }

        .datepicker .datepicker-switch:hover,
        .datepicker .next:hover,
        .datepicker .prev:hover,
        .datepicker tfoot tr th:hover {
            background-color: #EC661A !important;
            color: #fff !important;
        }

        .datepicker .ui-datepicker-header {
            background-color: #2196f3;
            color: white;
            text-align: center;
            font-family: 'Roboto';
            padding: 10px;
            height: 40px;
            border-radius: 8px 8px 0px 0px;
        }

        .datepicker .ui-datepicker-prev span,
        .datepicker .ui-datepicker-next span {
            display: none;
        }

        .datepicker .ui-datepicker-prev:after {
            content: "<";
            font-size: 2rem;
            float: left;
            margin-left: 10px;
            cursor: pointer;
        }


        .datepicker .ui-datepicker-next:after {
            content: ">";
            float: right;
            font-size: 2rem;
            margin-right: 10px;
            cursor: pointer;
        }

        .datepicker .ui-datepicker-calendar th {
            padding: 10px;
            color: #2196f3;
        }

        .datepicker .ui-datepicker-calendar {
            text-align: center;
            margin: 0 auto;
            padding: 8px;
        }

        .datepicker .ui-datepicker-title {
            padding: 10px;
        }

        .datepicker .ui-datepicker-calendar td {
            padding: 4px 0px;
        }

        .datepicker .ui-datepicker-calendar .ui-state-default {
            text-decoration: none;
            color: black;
        }

        .datepicker .ui-datepicker-calendar .ui-state-active {
            color: #2196f3;
        }

        .DTE_Field_Name_countryCode {
            width: 40%;
            float: left;
        }

        .DTE_Field_Name_telephone_1 {
            width: 70%;
            float: right;
        }

        .DTE_Field_Name_dob {
            width: 105%;
        }

        .DTE_Field_Name_telephone_1 label {
            visibility: hidden;
        }

        .read-only {
            background-color: rgba(75, 70, 92, .08) !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/css/flatpickr.css') }}">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/vuexy/js/flatpickr.js') }}"></script>
    <script>
        let sales_price = null;
        let commissions_charge_array = [];
        var commission_type = null;

        document.addEventListener('DOMContentLoaded', function() {
            $('#product_id').change(function(e) {
                // $("#create-sale")[0].reset();
                e.preventDefault();
                var product_id = $(this).val();
                var url = "{{ route('admin.sales.product', ':id') }}";
                url = url.replace(':id', product_id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        $('#company_id').val((response.company) ? response.company.name : 'N/A');
                        $('#compnay_name').val((response.compnay_name) ? response.compnay_name : 'N/A');
                        $('#product_code').val((response.code) ? response.code : 'N/A');
                        $('#product_price').val((response.product_price) ? response.product_price : 'N/A');
                        $('#product_sale_status').val((response.sale_status) ? response.sale_status : 'N/A');
                        $('#product_name').val((response.product_name) ? response.product_name : 'N/A');
                        $('#sales_status').val((response.sales_status) ? response.sales_status : 'N/A');

                        // $('#bh_operating_income').val((response.bh_sale_commissions) ? response.bh_sale_commissions : 'N/A');
                        $('#branch_representative').val((response.product_commissions) ?
                            response.product_commissions.normal.commission_bp : 'N/A');
                        $('#branch_agent').val((response.product_commissions) ? response.product_commissions.normal.commission_ba : 'N/A');
                        $('#managing_director').val((response.product_commissions) ? response.product_commissions.normal.commission_md : 'N/A');
                        $('#principal_managing_director').val((response.product_commissions) ? response.product_commissions.normal.commission_pmd : 'N/A');
                        $('#md').val((response.product_commissions) ? response.product_commissions.headquarter.md : 'N/A');
                        $('#pmd').val((response.product_commissions) ? response.product_commissions.headquarter.pmd : 'N/A');
                        $('#referral_bonus').val((response.referral_bonus) ? response.referral_bonus : 'N/A');

                        commissions_charge_array = [];

                        commissions_charge_array.push(
                            response.product_commissions.normal.commission_bp,
                            response.product_commissions.normal.commission_ba,
                            response.product_commissions.normal.commission_md,
                            response.product_commissions.normal.commission_pmd,
                            response.product_commissions.headquarter.md,
                            response.product_commissions.headquarter.pmd,
                            response.referral_bonus);

                        $('#other_fees').val((response.other_fees) ? response.other_fees : 'N/A');
                        //$('#referral_bonus_recipients').val((response.branch_representative) ? response.branch_representative : 'N/A');
                        $('#sales_status').val((response.sale_status) ? response.sale_status : 'N/A');
                        // $('#product_sale_status').val((response.branch_representative) ?
                        //     response.branch_representative : 'N/A');
                        //sales_price = response.product_price;

                        commission_type = response.commission_type;

                        if (commission_type === 'fixed-price') {
                            $('#fee_type').val((commission_type) ? "{{ trans('sale::sale.fixed-price') }}" : 'N/A');
                        } else {
                            $('#fee_type').val((commission_type) ? "{{ trans('sale::sale.with-ratio') }}" : 'N/A');
                            cleanCommissionsFields();
                        }
                    }

                });

            });

            $(".calendar").flatpickr({
                enableTime: !0,
                dateFormat: "Y-m-d H:i"
            })

            $('.inputmask').inputmask('decimal', {
                radixPoint: '.',
                autoGroup: true,
                rightAlign: false,
                groupSeparator: ','
            });

            setTimeout(() => {
                $('.alert').hide();
            }, 5000);

            const salesPriceInput = document.getElementById('sales_price');
            const numberOfSalesInput = document.getElementById('number_of_sales');
            const takeInput = document.getElementById('take');

            function calculateTakePrice() {
                const salesPrice = parseFloat(salesPriceInput.value.replace(/,/g, ''));
                const numberOfSales = parseInt(numberOfSalesInput.value);
                const takePrice = salesPrice * numberOfSales;
                takeInput.value = takePrice.toLocaleString(); // Set the calculated take price with commas
                setPercentages();
            }

            function setPercentages() {  // calculate the commission prices based on take value
                if (commission_type === "with-ratio") {
                    const takeInput = document.getElementById('take');
                    const takeVal = takeInput.value.replace(/,/g, '');
                    $('#branch_representative').val(calculatePercentage(takeVal, commissions_charge_array[0]));
                    $('#branch_agent').val(calculatePercentage(takeVal, commissions_charge_array[1]));
                    $('#managing_director').val(calculatePercentage(takeVal, commissions_charge_array[2]));
                    $('#principal_managing_director').val(calculatePercentage(takeVal, commissions_charge_array[3]));
                    $('#md').val(calculatePercentage(takeVal, commissions_charge_array[4]));
                    $('#pmd').val(calculatePercentage(takeVal, commissions_charge_array[5]));
                    $('#referral_bonus').val(calculatePercentage(takeVal, commissions_charge_array[6]));
                }
            }

            // Function to calculate percentage based on price and commission
            function calculatePercentage(price, commission) {
                if (!isNaN(price) && !isNaN(commission)) {
                    const percentage = (price * (commission / 100));
                    return percentage.toFixed(2);
                } else {
                    return 0;
                }
            }

            function cleanCommissionsFields() {
                document.querySelectorAll('.commission_charges').forEach(ele => {
                    ele.value = 0;
                });
            }

            // Calculate take price when either sales price or number of sales lose focus
            salesPriceInput.addEventListener('focusout', calculateTakePrice);
            numberOfSalesInput.addEventListener('focusout', calculateTakePrice);
            calculateTakePrice();
            setPercentages();




            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');

            popoverTriggerList.forEach(function (popoverTrigger) {
                let popoverInstance = null;

                function createPopover() {
                    if (!popoverInstance) {
                        popoverInstance = new bootstrap.Popover(popoverTrigger, {
                            trigger: 'focus',
                            html: true,
                            content: function () {
                                if (popoverTrigger.getAttribute('data-custom-content') === 'true') {
                                    const content = popoverTrigger.getAttribute('data-bs-content');
                                    let contentArray = document.documentElement.lang !== 'en' ?
                                        content.split("E") : // Split the content by E character
                                        content.split('. '); // Split the content by period and space

                                    // Create a new content string with bullet points
                                    let newContent = '<ul>';
                                    contentArray.forEach(item => {
                                        newContent += `<li>${item}</li>`;
                                    });
                                    newContent += '</ul>';

                                    return newContent;
                                } else {
                                    // Return the content directly for popovers that do not need special formatting
                                    return popoverTrigger.getAttribute('data-bs-content');
                                }
                            }
                        });
                    }
                }

                popoverTrigger.addEventListener('click', function (event) {
                    createPopover(); // Ensure popover is created if not already

                    // Toggle popover display
                    if (popoverInstance._element.getAttribute('aria-describedby')) {
                        popoverInstance.hide();
                    } else {
                        popoverInstance.show();
                    }

                    event.stopPropagation(); // Prevent event from bubbling up
                });

                document.addEventListener('click', function (event) {
                    if (!popoverTrigger.contains(event.target) && popoverInstance && popoverInstance._element.getAttribute('aria-describedby')) {
                        popoverInstance.hide();
                    }
                });

                popoverTrigger.addEventListener('hidden.bs.popover', function () {
                    if (popoverInstance) {
                        popoverInstance.dispose();
                        popoverInstance = null; // Reset instance to ensure clean state
                    }
                });
            });

        });
        document.addEventListener('livewire:load', function() {
            $('#seller_id').select2({
                placeholder: "Select"
            });
            $('#product_id').select2({
                placeholder: "Select"
            });
        });

    </script>

@stop
