@extends('adminlte::page')
@section('title', __('faq::faq.faq'))
@section('content_header')
    <x-core-content-header :title="__('faq::faq.faq')" :breadcrumbs="$breadcrumbs" />
@stop
@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>

    <style>
        .DTE_Field_Name_status .DTE_Field_InputControl div {
            display: flex !important;
            margin-right: 20px;
        }
    </style>

@stop


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/css/rtl/managemodal.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/katex.css') }}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .select2-container {
            z-index: 10000;
        }

        .card {
            --bs-card-spacer-x: 0 !important;
        }

        @media screen and (max-width: 767px) {
            div#faq-table_length {
                margin-top: 0;
            }
            div#faq-table_wrapper .align-items-center {
                margin-bottom: 30px;
                justify-content: space-between !important;
            }
            div#faq-table_filter ,
            div#faq-table_filter label,
            div#faq-table_filter input {
                width: 100%;
                margin-right: 0;
            }
            div#permission-table_wrapper {
                position: relative;

            }

            div#permission-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
            }

            div#permission-table_filter label {
                width: 100%;
            }

            div#permission-table_filter input {
                width: 78%;
                margin: 0;
            }

            div#permission-table_length {
                position: absolute;
                right: 0;
                top: 0;
                margin-top: 0;
            }

            div#permission-table_wrapper .align-items-center {
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
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.select2.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/quill/katex.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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
                    buttons: 'Update'
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
        });
    </script>
@stop
