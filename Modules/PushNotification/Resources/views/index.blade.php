@extends('adminlte::page')

@section('title', 'Settings')

@section('content_header')

    <x-core-content-header :title="__('pushnotification::pushnotification.push-notification')" :breadcrumbs="$breadcrumbs" />

@stop

@section('content')

    <x-adminlte-card theme="primary" theme-mode="outline">

        {!! $dataTable->table() !!}

    </x-adminlte-card>


    <div class="modal fade" id="notifiables_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content company-content">
                <div class="modal-header custom_modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close-modal-button btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body custom_modal-body">
                    <div class="table_div">
                        <table border="1" class="users-roles-table table" id="users-roles-table">
                            <tbody id="table-body">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <style>
        .modal-title {
            width: 100%;
            text-align: center;
            font-size: 24px;
            font-family: Pretendard;
            font-weight: 600;
            line-height: 28.64px;
            color: #2B2B2B;
        }
        #modal-title {
            text-transform: capitalize;
        }
        .select2-container {
            z-index: 10000;
        }

        .card {
            --bs-card-spacer-x: 0 !important;
        }

        .DTE_Field_InputControl div {
            display: flex;
            gap: 5px;
        }

        .btn-primary {
            color: #fff;
            background-color: #EC661A;
            border-color: #EC661A;
        }

        @media screen and (max-width: 767px) {
            div#push-notification-table_wrapper {
                position: relative;

            }

            div#push-notification-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
                width: 100%;
            }

            div#push-notification-table_filter label {
                width: 100%;
            }

            div#push-notification-table_filter input {
                width: 100%;
                margin: 0;
            }

            div#push-notification-table_length {
                margin-top: 0;
            }

            div#push-notification-table_wrapper .align-items-center {
                margin-bottom: 30px;
                justify-content: space-between !important;
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

            .modal .modal-header {
                justify-content: center;
            }
        }
    </style>
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.4.1/js/dataTables.rowGroup.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/editor/js/editor.select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/input-mask/inputmask.js') }}"></script>

    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
        });


        // editor for radio change event
        $(document).on('change', 'input[type=radio]', function() {
            // if the type is user show user list if it's role show role list with select2
            // role user
            $('.receiverSelect2').empty();
            if ($(this).val() == 2) {

                // make ajax call to get the user list
                $.ajax({
                    url: "{{ route('admin.push-notifications.users') }}",
                    type: 'GET',
                    success: function(response) {
                        let data = response;
                        let options = '';
                        data.forEach(function(item) {
                            options += '<option value="' + item.id + '">' + item.first_name +
                                ' (' + item.code + ' )' + '</option>';
                        });

                        $('.receiverSelect2').append(options);
                        $('.receiverSelect2').select2({
                            placeholder: 'Select User',
                            allowClear: true
                        });
                    }
                });
            } else {
                // make ajax call to get the role list
                $.ajax({
                    url: "{{ route('admin.push-notifications.roles') }}",
                    type: 'GET',
                    success: function(response) {
                        let data = response;
                        let options = '';
                        data.forEach(function(item) {
                            options += '<option value="' + item.id + '">' + item.name +
                                '</option>';
                        });

                        $('.receiverSelect2').append(options);
                        $('.receiverSelect2').select2({
                            placeholder: 'Select Role',
                            allowClear: true
                        });
                    }
                });

            }
        });


        function showReceivers(notification) {
            var url = "{{ route('admin.push-notifications.roles-users', ':key') }}";
            url = url.replace(':key', notification);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    if (response.notifiables.length != 0 ) {
                        var notifiables = response.notifiables;
                        appendDataToTable(notifiables, response.type);
                        $('#notifiables_modal').modal('show');
                    }
                    else {
                        Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "No users or roles assigned"
                            });
                    }
                }
            });
        }

        function appendDataToTable(data, type) {
            const tableBody = $('#users-roles-table #table-body');
            tableBody.empty();

            if (type == 'roles') {
                $('#modal-title').text("{{ __('pushnotification::pushnotification.roles') }}");

                $.each(data, function(index, item) {
                    const row = $('<tr>');
                    row.append($('<td>').text(item.display_name));
                    tableBody.append(row);
                });
            } else {
                $('#modal-title').text("{{ __('pushnotification::pushnotification.users') }}");

                $.each(data, function(index, item) {
                    const row = $('<tr>');
                    row.append($('<td>').text(item.first_name + ' (' + item.code + ')'));
                    tableBody.append(row);
                });
            }
        }

        $('.close-modal-button').click(function () {
            closeModal();
        });

        function closeModal() {
            $('#notifiables_modal').modal('hide');
        }
    </script>
@stop
