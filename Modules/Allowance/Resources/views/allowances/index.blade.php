@extends('adminlte::page')
@section('title', __('allowance::allowance.allowance-management'))
@section('content_header')
    <x-core-content-header :title="__('allowance::allowance.allowance-management')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{asset('/vendor/vuexy/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/css/flatpickr.css') }}">
    <style>
        .card .card-body{
            padding: 0px 0px 0px;
        }

        #allowance-table_wrapper .dt-buttons{
            height: 40px;
            font-size: 12px !important;
            text-align: right !important;
        }

        #allowance-table_wrapper .buttons-create{
            font-size: 12px !important;
        }

        #allowance-table_wrapper .btn {
            /* padding: 0px 8px !important; */
        }

        #allowance-table_wrapper .buttons-collection{
            font-size: 12px !important;
            /* padding: 0 13px !important; */
        }

        @media screen and (max-width: 767px) {
            div.dt-buttons{
                width: auto;
            }
            div#allowance-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
                width: 100%;
            }
            div#allowance-table_filter label {
                width: 100%;
            }
            div#allowance-table_wrapper .align-items-center {
                margin-top: 10px;
                margin-bottom: 30px;
                justify-content: space-between !important;
            }
            
            .dt-buttons {
                text-align: right!important;
                display: flex;
                column-gap: 10px;
            }
            div.dataTables_wrapper div.dataTables_filter input {
                width: 100%;
                margin-left: 0;
            }
            div#allowance-table_length{
                margin-top: 0;
            }
        }

        @media screen and (max-width: 425px) {
            div#allowance-table_length {
                position: absolute;
                right: 0;
                top: 0;

            }
            div.dataTables_wrapper div.dataTables_filter input {
                width: 75%;
            }
            div#allowance-table_wrapper .align-items-center {
                padding-right: 0px;
                justify-content: flex-end !important;
            }
        }
        @media screen and (max-width: 375px) {
            div.dataTables_wrapper div.dataTables_filter input {
                width: 70%;
            }
        }
        @media screen and (max-width: 320px) {
            div#allowance-table_filter input {
                width: 70%;
            }
        }

    </style>
@stop
@section('content')
    <!-- Your existing content goes here -->
    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>
    <div class="modal" tabindex="-1" role="dialog" id="bh-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title">수수료{{ trans('sale::sale.fees-title') }}</h5> --}}
                    <h5 class="modal-title">수수료</h5>

                    <button class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="body-main">
                        <div class="main">
                            <div class="bh-sales">
                                <div class="bh-header">
                                    <div class="title">BH 매출 수수료</div>
                                </div>
                                <div class="amount" id="bh-amount">150,000</div>
                            </div>

                            <div class="comission-main">
                                <div class="comission-header">
                                    <div class="comission-title">커미션</div>
                                </div>
                                <div class="comission-body">
                                    <div class="header">
                                        <div class="title-header">
                                            <div class="title">지사대표(bp)</div>
                                        </div>
                                        <div class="amount" id="bp-amount">80,000</div>
                                    </div>
                                    <div class="header">
                                        <div class="title-header">
                                            <div class="title">지사대표(ba)</div>
                                        </div>
                                        <div class="amount" id="ba-amount">-</div>
                                    </div>
                                    <div class="header">
                                        <div class="title-header">
                                            <div class="title">본부대표(MD)</div>
                                        </div>
                                        <div class="amount" id="md-amount">-</div>
                                    </div>
                                    <div class="header">
                                        <div class="title-header">
                                            <div class="title">본부대표(PMD)</div>
                                        </div>
                                        <div class="amount" id="pmd-amount">-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="comission-main">
                                <div class="comission-header">
                                    <div class="comission-title">본부대표수당</div>
                                </div>
                                <div class="comission-body">
                                    <div class="header">
                                        <div class="title-header">
                                            <div class="title">본부대표(MD)</div>
                                        </div>
                                        <div class="amount" id="hd-md">-</div>
                                    </div>
                                    <div class="header">
                                        <div class="title-header">
                                            <div class="title">본부대표(PMD)</div>
                                        </div>
                                        <div class="amount" id="hd-pmd">16000</div>
                                    </div>
                                </div>
                            </div>

                            <div class="bh-sales">
                                <div class="bh-header">
                                    <div class="title">추천보너스</div>
                                </div>
                                <div class="amount" id="referral-bonus"></div>
                            </div>
                            <div class="bh-sales">
                                <div class="bh-header">
                                    <div class="title">추천보너스 받는 사람</div>
                                </div>
                                <div class="amount" id="referral-user">24,000</div>
                            </div>
                            <div class="bh-sales">
                                <div class="bh-header">
                                    <div class="title">기타수수료</div>
                                </div>
                                <div class="amount" id="other-fee">24,000</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="footer-main">
                        <div class="footer">
                            <div class="footer-parent">
                                <div>확인</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="allowance_delete_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content company-content">
                <div class="modal-header">
                    <h5 class="text-dark">@lang('core::modal.delete-title')</h5>
                </div>
                <div class="modal-body">@lang('core::modal.delete-message')</div>
                <div class="modal-footer">
                    <button class="btn btn-primary delete-allowance" data-clicked="false"
                        tabindex="0">@lang('core::modal.delete')</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="allowance_look_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content company-content">
                <div class="modal-header">
                    <h5 class="modal-title custom_modal-title">{{ trans('allowance::popup-data.allowance-data') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="table_div">
                        <table border="1" id="allowance_look_modal_table" class="company-table">
                            <tr>
                                <td class="titles">{{ trans('allowance::popup-data.hq-representative') }}</td>
                                <td id="headquarters_representative">한바다</td>
                            </tr>
                            <tr>
                                <td class="titles">{{ trans('allowance::popup-data.organizational-division') }}</td>
                                <td id="organizational_division">김하준</td>
                            </tr>
                            <tr>
                                <td class="titles">{{ trans('allowance::popup-data.policy') }}</td>
                                <td id="policy">김하준</td>
                            </tr>
                            <tr>
                                <td class="titles">{{ trans('allowance::popup-data.other') }}</td>
                                <td id="other">김하준</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary"
                        onclick="return $('#allowance_look_modal').modal('hide')">{{ trans('allowance::popup-data.btn-close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Include the Livewire component -->

    <!-------------------------------------Show Image modal------------------------------------------------------>
    <div class="modal fade pdf-modal-img" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Allowance Data Import</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.allowances.importData') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Import Data</label>
                                <input type="file" name="importAllowanceData" id="allowanceData" class="form-control" accept=".xlsx, .xls">
                            </div>
                            <div class="col-sm-3 m-auto mt-3">
                                <button class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------Show Image modal------------------------------------------------------>

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
@stop
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/input-mask/inputmask.js') }}"></script>
    <script type="text/javascript" src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
    {!! $dataTable->scripts() !!}
    <!-- Add script to handle modal show/hide -->

    <script>
        $(document).ready(function () {
            $('#import').click(function () {
                $('#imageModal').modal('show');
            });

        });
    </script>

    <script>
        Livewire.on('modalClosed', function() {
            $('#myModal').modal('hide');
        });
    </script>
    <script>
        let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
        let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];

        // Delete a record
        grid.on('click', 'button.allowance_delete', function(e) {
            e.preventDefault();
            var selectedAllowanceid = $(this).attr('data-url');
            var url = "{{ route('admin.allowances.delete', ':product') }}";
            url = url.replace(':product', selectedAllowanceid);
            $('#allowance_delete_modal').modal('show');
            $(document).on('click', '.delete-allowance', function(e) {
                e.preventDefault();
                $(this).data('clicked', true);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        window.LaravelDataTables["allowance-table"].ajax.reload();
                        $('#allowance_delete_modal').modal('hide');
                    }
                });
            });
        });
        grid.on('click', 'button.allowance_look_btn', function(e) {
            e.preventDefault();
            let table = $('#allowance_look_modal_table')
            table.html('')
            let data = `<tr><td class="titles">{{ trans('allowance::popup-data.hq-representative') }}</td>
                             <td>${$(this).attr('data-headquarters_representative')}</td>
                        </tr>
                        <tr>
                            <td class="titles">{{ trans('allowance::popup-data.organizational-division') }}</td>
                            <td>${$(this).attr('data-organizational_division')}</td>
                        </tr>
                        <tr>
                            <td class="titles">{{ trans('allowance::popup-data.policy') }}</td>
                            <td>${$(this).attr('data-policy')}</td>
                        </tr>
                        <tr>
                            <td class="titles">{{ trans('allowance::popup-data.other') }}</td>
                            <td>${$(this).attr('data-other')}</td>
                        </tr>`
            table.html(data)
            $('#allowance_look_modal').modal('show');
        });
        $('.btn-close').on('click', function() {
            $('#bh-modal').modal('hide');
        })

        setTimeout(() => {
            $('.alert').hide();
        }, 2000);
    </script>


    <script type="text/javascript" src="{{ asset('/vendor/vuexy/js/extended-ui-perfect-scrollbar.js') }}"></script>
@stop
