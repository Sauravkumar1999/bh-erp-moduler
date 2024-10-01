@extends('adminlte::page')
@section('title', __('product::product.product'))
@section('content_header')
    <x-core-content-header :title="__('product::product.product')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <style>
        label {
            margin-left: 0.25em !important;
        }

        input[type="radio"]:checked {
            border-color: #EC661A;
        }

        input[type="radio"]:checked {
            background-color: #EC661A;
        }

        .DTE_Field_InputControl div {
            display: flex;
            gap: 5px;
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

        .charge_btn {
            background: rgb(34 188 179);
            border: none;
            color: #fff;
            border-radius: 2px;
            padding: 4px 10px;
        }

        .dataTable th,
        .dataTable td {
            white-space: nowrap;
            font-size: 14px;
            color: #000 !important;
        }

        .dtb-popover-close {
            display: none !important;
        }

        #product-table_wrapper .dt-buttons{
            text-align: right !important;
        }

        @media screen and (max-width: 767px) {
            div#product-table_wrapper {
                position: relative;

            }

            div#product-table_filter {
                width: 100%;
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
            }

            div#product-table_filter label {
                width: 100%;
            }

            div#product-table_filter input {
                width: 100%;
                margin: 0;
            }

            div#product-table_length {
                margin-top: 0;
            }
            div#product-table_length label{
                margin-left:0 !important;
            }

            div#product-table_wrapper .align-items-center {
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

            .modal.show .modal-dialog {
                transform: translateY(100px) scale(1) !important;
            }

            .card .card-body {
                padding: 0px 0px 0px;
            }
        }


    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@stop
@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>

    <div class="modal fade" id="charge-details" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content company-content">
                <div class="modal-header custom_modal-header">
                    <h5 class="modal-title custom_modal-title">{{ __('product::product.charge') }}</h5>
                    <button type="button" class="close-modal-button" data-dismiss="modal" onclick="closeModal()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body custom_modal-body">
                    <div class="table_div">
                        <table border="1" class="company-table">
                            @if (user()->isAdmin('admin|chief'))
                                <tr>
                                    <td colspan="2" class="titles">{{ __('product::product.bh-sales-commission') }}</td>
                                    <td id="bh_sale_commissions" class="clear-charge-td"> - </td>
                                </tr>
                            @endif
                            @if (user()->hasRole('BP|admin|chief'))
                                <tr>
                                    <td rowspan="4" class="titles speialone">{{ __('product::product.commission') }}</td>
                                    <td class="titles">{{ __('product::product.branch-representative') }}</td>
                                    <td id="normal_commission_bp" class="clear-charge-td"> - </td>
                                </tr>
                            @endif
                            @if (user()->hasRole('BA|admin|chief'))
                                <tr>
                                    <td class="titles">{{ __('product::product.branch-agent') }}</td>
                                    <td id="normal_commission_ba" class="clear-charge-td">80,000</td>
                                </tr>
                            @endif
                            @if (user()->hasRole('MD|admin|chief'))
                                <tr>
                                    <td class="titles">{{ __('product::product.managing-director') }}</td>
                                    <td id="normal_commission_md" class="clear-charge-td"> - </td>
                                </tr>
                            @endif
                            @if (user()->hasRole('PMD|admin|chief'))
                                <tr>
                                    <td class="titles">{{ __('product::product.principal-managing-director') }}</td>
                                    <td id="normal_commission_pmd" class="clear-charge-td"> - </td>
                                </tr>
                            @endif
                            @if (user()->hasRole('MD|admin|chief'))
                                <tr>
                                    <td class="titles speialone" rowspan="2">
                                        {{ __('product::product.headquarters-representative-allowance') }}</td>
                                    <td class="titles">{{ __('product::product.managing-director') }}</td>
                                    <td id="headquarter_md" class="clear-charge-td"> - </td>
                                </tr>
                            @endif
                            @if (user()->hasRole('PMD|admin|chief'))
                                <tr>
                                    <td class="titles">{{ __('product::product.principal-managing-director') }}</td>
                                    <td id="headquarter_pmd" class="clear-charge-td">16,000</td>
                                </tr>
                            @endif
                            @if (user()->hasRole('admin|chief'))
                                <tr>
                                    <td colspan="2" class="titles">{{ __('product::product.other-fees') }}</td>
                                    <td id="other_fees" class="clear-charge-td"> - </td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="2" class="titles">{{ __('product::product.referral-bonus') }}</td>
                                <td id="referral_bonus" class="clear-charge-td">16,000</td>
                            </tr>
                        </table>
                    </div>
                    <div class="button_div">
                        <button class="btn btn-primary compay_button" onclick="closeModal()" id="compay_button">{{ __('product::product.check') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="banner-details" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content company-content">
                <div class="modal-header">
                    <h5 class="modal-title custom_modal-title">배너</h5>
                    <button type="button" class="close-modal-button" data-dismiss="modal" onclick="closeModal()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table_div">
                        <img class="h-100 w-100" src="{{ asset('vendor/vuexy/img/products/product.png') }}">
                    </div>
                    <div class="button_div">
                        <button class="btn btn-primary compay_button" id="compay_button" onclick="closeModal()">확인 </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="product-data" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content company-content">
                <div class="modal-header">
                    <h5 class="text-dark">{{ trans('core::modal.delete-title') }}</h5>
                </div>
                <div class="modal-body">{{ trans('core::modal.delete-message') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-primary delete-product" data-clicked="false"
                        tabindex="0">{{ trans('core::modal.delete') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="manager-details" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content company-content">
                <div class="modal-header ">
                    <h5 class="modal-title custom_modal-title">{{ __('product::product.manager') }}</h5>
                    <button type="button" class="close-modal-button" data-dismiss="modal" onclick="closeModal()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table_div">
                        <table border="1" class="company-table">
                            <tr>
                                <td class="titles">{{ __('Product::manager.belong') }}</td>
                                <td id="belong" class="clear-manager-td">한바다</td>
                            </tr>

                            <tr>
                                <td class="titles">{{ __('Product::manager.name') }}</td>
                                <td id="name" class="clear-manager-td">김하준</td>
                            </tr>
                            <tr>

                                <td class="titles">{{ __('Product::manager.position') }}</td>
                                <td id="position" class="clear-manager-td">과장</td>
                            </tr>
                            <tr>

                                <td class="titles">{{ __('Product::manager.contact') }}</td>
                                <td id="contact" class="clear-manager-td">010-1234-5678</td>
                            </tr>

                            <tr>

                                <td class="titles">{{ __('Product::manager.email') }}</td>
                                <td id="email" class="clear-manager-td">kkk@co.kr</td>
                            </tr>

                        </table>
                    </div>
                    <div class="button_div">
                        <button class="btn btn-primary compay_button"
                            id="compay_button" onclick="closeModal()">{{ __('product::product.check') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.print.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];

            // Delete a record
            grid.on('click', 'button.editor-delete', function(e) {
                e.preventDefault();
                var selectedProductid = $(this).attr('data-url');
                var url = "{{ route('admin.products.delete', ':product') }}";
                url = url.replace(':product', selectedProductid);
                $('#product-data').modal('show');
                $(document).on('click', '.delete-product', function(e) {
                    e.preventDefault();
                    $(this).data('clicked', true);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        dataType: "json",
                        success: function(response) {
                            window.LaravelDataTables["product-table"].ajax.reload();
                            $('#product-data').modal('hide');
                        }
                    });
                });

            });

        });

        // $(document).on("click", "button.manager_btn", function(e) {
        //     e.preventDefault();
        //     $('#manager-details').modal('show');

        // });

        // $(document).on("click", "button.charge_btn", function(e) {
        //     e.preventDefault();
        //     $('#charge-details').modal('show');

        // });


        $(document).on("click", "button.banner_btn", function(e) {
            e.preventDefault();
            var url = this.getAttribute('data-url');
            let img = $('#banner-details').find('img');
            img.attr('src', url);
            $('#banner-details').modal('show');
        });


        function closeModal() {
            $('#charge-details').modal('hide');
            $('#manager-details').modal('hide');
            $('#banner-details').modal('hide');

        }
        setTimeout(() => {
            $('.alert').hide();
        }, 2000);


        function getCommissionChargeDetails(product_id) {
            let button = event.target
            var url = "{{ route('admin.products.commission-charge', ':id') }}";
            url = url.replace(':id', product_id);
            $('.clear-charge-td').text('');
            button.innerHTML = `<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Loading...`
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    button.innerHTML = "{{ trans('product::product.look') }}"
                    var product = response.product;
                    $('#charge-details #bh_sale_commissions').text(product.bh_sale_commissions);
                    $('#charge-details #normal_commission_bp').text(product.product_commissions ? formatNumber(
                        product.product_commissions.normal.commission_bp) : '');
                    $('#charge-details #normal_commission_ba').text(product.product_commissions ? formatNumber(
                        product.product_commissions.normal.commission_ba) : '');
                    $('#charge-details #normal_commission_md').text(product.product_commissions ? formatNumber(
                        product.product_commissions.normal.commission_md) : '');
                    $('#charge-details #normal_commission_pmd').text(product.product_commissions ? formatNumber(
                        product.product_commissions.normal.commission_pmd) : '');
                    $('#charge-details #headquarter_md').text(product.product_commissions ? formatNumber(product
                        .product_commissions.headquarter.md) : '');
                    $('#charge-details #headquarter_pmd').text(product.product_commissions ? formatNumber(
                        product.product_commissions.headquarter.pmd) : '');
                    $('#charge-details #other_fees').text(product.other_fees);
                    $('#charge-details #referral_bonus').text(product.referral_bonus);
                    $('#charge-details').modal('show');
                }
            });
        }

        function formatNumber(number) {
            return new Intl.NumberFormat().format(number);
        }

        function getManagerDetails(product_id) {
            let button = event.target
            var url = "{{ route('admin.products.manager', ':id') }}";
            url = url.replace(':id', product_id);
            $('.clear-manager-td').text(''); // Clear the previous data
            button.innerHTML = `<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Loading...`
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    button.innerHTML = "{{ trans('product::product.look') }}";
                    const user = response.product.user || {};
                    const company = user.company || {};
                    const roles = user.roles || [];
                    const contacts = user.contacts || [];
                    $('#manager-details #belong').text(company.name || 'N/A');
                    $('#manager-details #name').text(`${user.first_name || ''} ${user.last_name || 'N/A'}`);
                    $('#manager-details #position').text(roles.length ? roles[0].name : 'N/A');
                    $('#manager-details #email').text(user.email || 'N/A');
                    $('#manager-details #contact').text(contacts.length ? contacts[0].telephone_1 : 'N/A');
                    $('#manager-details').modal('show');
                }
            });
        }
    </script>
@stop
