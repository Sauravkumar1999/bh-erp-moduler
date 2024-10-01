@extends('adminlte::page')

@section('title', $title)

@section('content_header')

    <x-core-content-header :title="$title" :breadcrumbs="$breadcrumbs"/>

@stop

@section('content')

    <x-adminlte-card theme="primary" theme-mode="outline">

        {!! $dataTable->table() !!}

    </x-adminlte-card>

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/css/rtl/managemodal.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css')}}">
    <style>
    .card {
        --bs-card-spacer-x: 0 !important;
    }
    @media screen and (max-width: 767px) {
             #translations-table_wrapper {
                position: relative;

            }

            div#translations-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
                width: 100%;
            }

            div#translations-table_filter label {
                width: 100%;
            }

            div#translations-table_filter input {
                width: 100%;
                margin: 0;
            }

            div#translations-table_length {
                margin-top: 0;
            }

            div#permission-table_wrapper .align-items-center {
                margin-bottom: 30px;
            }
            div#translations-table_wrapper .align-items-center {
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
    <script type="text/javascript" src="{{asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js')}}"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
            // Edit record
            grid.on('click', 'button.editor-edit', function(e) {
                e.preventDefault();
                editor.edit(e.target.closest('tr'), {
                    title: 'Edit record',
                    buttons: [{
                            text: '<?php echo trans('core::modal.cancellation') ?>',
                            action: function() {
                                editor.close();
                            }
                        },
                        {
                            text: '<?php echo trans('core::modal.save') ?>',
                            action: function() {
                                editor.submit();
                            }
                        }

                    ]
                });
            });

            // Delete a record
            grid.on('click', 'button.editor-delete', function(e) {
                e.preventDefault();
                editor.remove(e.target.closest('tr'), {
                    title: '{{ trans('core::modal.delete-title') }}',
                    message: '{{ trans('core::modal.delete-message') }}',
                    buttons: '{{ trans('core::modal.delete') }}',
                });
            });
        })
    </script>
@stop
