@extends('adminlte::page')

@section('title', __('user::user.user'))

@section('content_header')

    <x-core-content-header :title="@lang('sale::sale.sales-management')" :breadcrumbs="$breadcrumbs" />

@stop

@section('content')
    <!-- Your existing content goes here -->
    <x-adminlte-card theme="primary" theme-mode="outline">

        {!! $dataTable->table() !!}

    </x-adminlte-card>


    <div class="modal fade" id="bh-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content company-content">
                <div class="modal-header custom_modal-header">
                    <h5 class="modal-title custom_modal-title">{{ __('Product::product.charge') }}</h5>
                    <button type="button" class="close-modal-button btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body custom_modal-body">
                    <div class="table_div">
                        <table border="1" class="company-table">
                            <tr>
                                <td colspan="2" class="titles">{{ __('product::product.bh-sales-commission') }}</td>
                                <td id="bh-amount"> - </td>
                            </tr>
                            <tr>
                                <td rowspan="4" class="titles speialone">{{ __('product::product.commission') }}</td>
                                <td class="titles">{{ __('product::product.branch-representative') }}</td>
                                <td id="bp-amount"> - </td>
                            </tr>
                            <tr>
                                <td class="titles">{{ __('product::product.branch-agent') }}</td>
                                <td id="ba-amount">80,000</td>
                            </tr>
                            <tr>
                                <td class="titles">{{ __('product::product.managing-director') }}</td>
                                <td id="md-amount"> - </td>
                            </tr>
                            <tr>
                                <td class="titles">{{ __('product::product.principal-managing-director') }}</td>
                                <td id="pmd-amount"> - </td>
                            </tr>
                            <tr>
                                <td class="titles speialone" rowspan="2">
                                    {{ __('product::product.headquarters-representative-allowance') }}</td>
                                <td class="titles">{{ __('product::product.managing-director') }}</td>
                                <td id="hd-md"> - </td>
                            </tr>
                            <tr>
                                <td class="titles">{{ __('product::product.principal-managing-director') }}</td>
                                <td id="hd-pmd">16,000</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="titles">{{ __('product::product.other-fees') }}</td>
                                <td id="referral-bonus"> - </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="titles">{{ __('product::product.referral-user') }}</td>
                                <td id="referral-user"> - </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="titles">{{ __('product::product.other-fees') }}</td>
                                <td id="other-fee">16,000</td>
                            </tr>
                        </table>
                    </div>
                    <div class="button_div">
                        <button class="btn btn-primary compay_button close"
                            id="compay_button">{{ __('product::product.check') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the Livewire component -->
@stop


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">

    <style>
        #sale-table_wrapper .dt-buttons{
            text-align: right !important;
        }

        #user-table_filter {
            margin-top: 1rem;
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

        .modal-header .btn-close {
            transform: translate(0px, 0px) !important;
            background-color: rgba(92, 70, 70, 0.08);
            color: rgb(92, 70, 70);
            box-shadow: none;
            cursor: pointer !important;
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

        .footer-main {
            align-self: stretch;
            height: 70px;
            padding: 16px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            display: flex
        }

        .footer-main .footer {
            padding-left: 20px;
            padding-right: 20px;
            background: #EC661A;
            border-radius: 6px;
            justify-content: center;
            align-items: center;
            display: inline-flex
        }

        .footer-main .footer .footer-parent {
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
            justify-content: center;
            align-items: center;
            gap: 12px;
            display: flex
        }

        .footer-main .footer .footer-parent div {
            color: white;
            font-size: 16px;
            font-family: Public Sans;
            font-weight: 500;
            line-height: 18px;
            word-wrap: break-word;
        }

        .modal-footer {
            justify-content: center !important;
        }


        .body-main {
            width: 100%;
            height: 100%;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;
            display: inline-flex
        }

        .body-main .main {
            align-self: stretch;

            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex
        }

        .body-main .main .bh-sales {
            align-self: stretch;
            height: 48px;
            background: white;
            border: 1px #DBDADE solid;
            justify-content: flex-start;
            align-items: center;
            gap: 20px;
            display: inline-flex
        }

        .bh-sales .bh-header {
            width: 278px;
            height: 48px;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 8px;
            padding-bottom: 8px;
            background: rgba(236, 102, 26, 0.07);
            justify-content: flex-start;
            align-items: center;
            gap: 4px;
            display: flex;
        }

        .bh-header .title {
            color: #2B2B2B;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            word-wrap: break-word
        }



        .comission-main {
            background: white;
            border: 1px #DBDADE solid;
            justify-content: center;
            align-items: flex-start;
            display: inline-flex
        }

        .comission-main .comission-header {
            width: 128px;
            align-self: stretch;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 8px;
            padding-bottom: 8px;
            background: rgba(236, 102, 26, 0.07);
            justify-content: flex-start;
            align-items: center;
            gap: 4px;
            display: inline-flex
        }

        .comission-main .comission-header .comission-title {
            color: #2B2B2B;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            word-wrap: break-word
        }

        .comission-main .comission-body {
            align-self: stretch;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: inline-flex
        }

        .comission-body .header {
            /* width: 690px; */
            background: white;
            /* border: 0.1px #DBDADE solid; */
            border-left: 1px #DBDADE solid;
            border-bottom: 1px #DBDADE solid;
            justify-content: flex-start;
            align-items: center;
            gap: 20px;
            display: inline-flex;
        }

        .comission-body .header:last-child {
            border-bottom: none;
        }

        .comission-body .title-header {
            /* width: 150px; */
            height: 48px;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 8px;
            padding-bottom: 8px;
            background: rgba(236, 102, 26, 0.07);
            justify-content: flex-start;
            align-items: center;
            gap: 4px;
            display: flex
        }

        .comission-body .title-header .title {
            color: #2B2B2B;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            word-wrap: break-word
        }

        .comission-body .amount {
            color: #2B2B2B;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 400;
            word-wrap: break-word
        }

        .confirmed {
            background: rgba(0, 207, 232, 0.16) !important;
            color: #00CFE8 !important;
            font-size: 13px;
            font-family: Public Sans;
            font-weight: 500;
            line-height: 16px;
            word-wrap: break-word
        }

        .proceeding {
            background: rgba(40, 199, 111, 0.16) !important;
            color: #28C76F !important;
            font-size: 13px;
            font-family: Public Sans;
            font-weight: 500;
            line-height: 16px;
            word-wrap: break-word
        }

        .cancellation {
            background: rgba(255, 159, 67, 0.16) !important;
            color: #FF9F43 !important;
            font-size: 13px;
            font-family: Public Sans;
            font-weight: 500;
            line-height: 16px;
            word-wrap: break-word
        }

        .refund {
            background: rgba(234, 84, 85, 0.16) !important;
            color: #EA5455 !important;
            font-size: 13px;
            font-family: Public Sans;
            font-weight: 500;
            line-height: 16px;
            word-wrap: break-word
        }

        .modal.show .modal-dialog {
            max-width: 53rem !important;
        }

        .custom-btn {
            border: none;
            border-radius: 2px;
            padding: 4px 10px;
        }

        .dtb-popover-close {
            display: none !important;
        }
       
    </style>

    <style>
        .card .card-body {
            padding: 0px 0px 0px;
        }

        .button1 {
            background: rgb(221 246 232);
            border: none;
            color: #41cd80;
            border-radius: 2px;
            padding: 4px 10px;
        }

        .button2 {
            background: rgb(255 240 225);
            border: none;
            color: #ff9836;
            border-radius: 2px;
            padding: 4px 10px;
        }

        .button3 {
            background: rgb(226 226 226);
            border: none;
            color: #4b4b4b;
            border-radius: 2px;
            padding: 4px 10px;
        }

        .button4 {
            background: rgb(233 231 253);
            border: none;
            color: #7064f0;
            border-radius: 2px;
            padding: 4px 10px;
        }

        @media screen and (max-width: 767px) {
            div#sale-table_wrapper {
                position: relative;

            }

            div#sale-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
                width: 100%;
            }

            div#sale-table_filter label {
                width: 100%;
            }

            div#sale-table_filter input {
                width: 100%;
                margin: 0;
            }

            div#sale-table_length {
                margin-top: 0;
            }

            div#sale-table_wrapper .align-items-center {
                margin-bottom: 30px;
            }

            .modal.DTED.fade.show .modal-dialog {
                left: 0px !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
                height: 90% !important;
            }

            .modal-backdrop {
                height: 90% !important;
                position: fixed !important;
                top: 11% !important;
            }

            .modal-dialog-centered {
                position: fixed;
                bottom: 0px;
                min-height: 90% !important;
                overflow-y: scroll;
            }
        }


        @media screen and (max-width: 320px) {
            #sale-table_wrapper .dt-buttons {
                display: flex;
                gap: 4px;
            }
        }
    </style>


@stop

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/input-mask/inputmask.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <!-- Add script to handle modal show/hide -->
    <script>
        Livewire.on('modalClosed', function() {
            $('#myModal').modal('hide');
        });
    </script>
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
            // Delete a record
            grid.on('click', 'button.editor-delete', function(e) {
                e.preventDefault();

                editor.remove(e.target.closest('tr'), {
                    title: '{{ trans('core::modal.delete-title') }}',
                    message: '{{ trans('core::modal.delete-message') }}',
                    buttons: '{{ trans('core::modal.delete') }}',
                });
            });

            grid.on('draw.dt', function() {
                $('#user-table tbody tr').each(function() {
                    var statusCell = grid.cell($(this), 'status:name');
                    var status = statusCell.data();
                    if (status == '<?php echo trans('user::user.approval'); ?>') {
                        statusCell.node().style.color = '#28C76F';
                    } else if (status == '<?php echo trans('user::user.waiting'); ?>') {
                        statusCell.node().style.color = '#FF9F43';
                    }
                });
            });
            setTimeout(() => {
                $('.alert').hide();
            }, 2000);
        });

        //total = take
        function openBHModal(id, total) {
            var product_id = id;
            var url = "{{ route('admin.sales.product', ':id') }}";
            url = url.replace(':id', product_id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {

                    var sales_commission, bp_amount, ba_amount, md_amount, pmd_amount, hd_md, hd_pmd,
                        referral_bonus;
                    sales_commission = response.bh_sale_commissions;
                    bp_amount = response.product_commissions.normal.commission_bp;
                    ba_amount = response.product_commissions.normal.commission_ba;

                    md_amount = response.product_commissions.normal.commission_md;
                    pmd_amount = response.product_commissions.normal.commission_pmd;

                    hd_md = response.product_commissions.headquarter.md;
                    hd_pmd = response.product_commissions.headquarter.pmd;
                    referral_bonus = response.referral_bonus;

                    if (response.commission_type == "with-ratio") {
                        var ava = (total / 100);
                        sales_commission *= ava;
                        bp_amount *= ava;
                        ba_amount *= ava;
                        md_amount *= ava;
                        pmd_amount *= ava;
                        hd_md *= ava;
                        hd_pmd *= ava;
                        referral_bonus *= ava;
                    }
                    $('#bh-amount').text(formatNumber(sales_commission));
                    $('#bp-amount').text(formatNumber(bp_amount));
                    $('#ba-amount').text(formatNumber(ba_amount));
                    $('#md-amount').text(formatNumber(md_amount));
                    $('#pmd-amount').text(formatNumber(pmd_amount));
                    $('#hd-md').text(formatNumber(hd_md));
                    $('#hd-pmd').text(formatNumber(hd_pmd));


                    $('#referral-bonus').text(formatNumber(referral_bonus));
                    $('#referral-user').text(response.user.first_name + ' ' + response.user.last_name + ' ' +
                        response.user.code);
                    $('#other-fee').text(response.other_fees);
                }
            });
            $('#bh-modal').modal('show');
        }

        $('.btn-close').on('click', function() {
            $('#bh-modal').modal('hide');
        })
        $('#bh-modal .close').on('click', function() {
            $('#bh-modal').modal('hide');
        });

        function formatNumber(number) {
            return new Intl.NumberFormat().format(number.toFixed(2));
        }
    </script>


    <script type="text/javascript" src="{{ asset('/vendor/vuexy/js/extended-ui-perfect-scrollbar.js') }}"></script>
@stop
