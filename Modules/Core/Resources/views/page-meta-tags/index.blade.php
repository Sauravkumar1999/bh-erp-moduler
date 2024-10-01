@extends('adminlte::page')
@section('title', __('core::page-meta.page-meta-tags'))
@section('content_header')
    <x-core-content-header :title="__('core::page-meta.page-meta-tags')" :breadcrumbs="$breadcrumbs" />
@stop
@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>
    <div class="modal fade" id="pagemeta-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content company-content">
                <div class="modal-header">
                    <h5 class="text-dark">{{ trans('core::modal.delete-title') }}</h5>
                </div>
                <div class="modal-body">{{ trans('core::modal.delete-message') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-primary delete-pagemeta" data-clicked="false"
                        tabindex="0">{{ trans('core::modal.delete') }}</button>
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
        .select2-container {
            z-index: 10000;
        }

        .card {
            --bs-card-spacer-x: 0 !important;
        }

        @media screen and (max-width: 767px) {
            div#page-meta-table_length {
                margin-top: 0;
            }
            div#page-meta-table_wrapper .align-items-center {
                margin-bottom: 30px;
                justify-content: space-between !important;
            }
            div#page-meta-table_filter ,
            div#page-meta-table_filter label,
            div#page-meta-table_filter input {
                width: 100%;
                margin-right: 0;
            }
            div#settings-table_wrapper {
                position: relative;

            }

            div#settings-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
            }

            div#settings-table_filter label {
                width: 100%;
            }

            div#settings-table_filter input {
                width: 78%;
                margin: 0;
            }

            div#settings-table_length {
                position: absolute;
                right: 0;
                top: 0;
                margin-top: 0;
            }

            div#settings-table_wrapper .align-items-center {
                padding-right: 0px;
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
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
            // Edit record
            grid.on('click', 'button.editor-edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('admin.page-meta-tags.edit', ':pagemeta') }}";
                url = url.replace(':pagemeta', id);
                window.location.href = url;
            });
            // Delete a record
            grid.on('click', 'button.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var url = "{{ route('admin.page-meta-tags.destroy', ':pagemeta') }}";
                url = url.replace(':pagemeta', id);
                $('#pagemeta-modal').modal('show');
                $(document).on('click', '.delete-pagemeta', function(e) {
                    e.preventDefault();
                    $(this).data('clicked', true);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            window.LaravelDataTables["page-meta-table"].ajax.reload();
                            $('#pagemeta-modal').modal('hide');
                        }
                    });

                });

            });

            function openAddModal() {
                return
                $('#addDataModal').modal('show');
            }
        });
    </script>
@stop
