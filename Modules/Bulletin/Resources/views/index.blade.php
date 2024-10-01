@extends('adminlte::page')

@section('title', trans('bulletin::msg.bulletin' . (!auth()->user()->isAdmin() ? '-user' : '')))

@section('content_header')

    <x-core-content-header title="{{ trans('bulletin::msg.bulletin' . (!auth()->user()->isAdmin() ? '-user' : '')) }}"
        :breadcrumbs="$breadcrumbs" />

@stop

@section('content')

    <x-adminlte-card theme="primary" theme-mode="outline">

        {!! $dataTable->table() !!}

    </x-adminlte-card>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/css/rtl/managemodal.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/katex.css') }}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


    <style>
        .modal.DTED.fade.modal-sm .modal-dialog {
            max-width: 500px;
        }

        .modal.DTED.fade.modal-sm .modal-dialog .modal-content .DTE_Body.modal-body .DTE_Body_Content .form-horizontal .DTE_Form_Content .DTE_Field_Name_distinguish .DTE_Field_InputControl div {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .modal.DTED.fade.modal-sm .modal-dialog .modal-content .DTE_Body.modal-body .DTE_Body_Content .form-horizontal .DTE_Form_Content .DTE_Field_Name_distinguish .DTE_Field_InputControl div div {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .modal.DTED.fade.modal-sm .modal-dialog .modal-content .DTE_Body.modal-body .DTE_Body_Content .form-horizontal .DTE_Form_Content .DTE_Field_Name_distinguish .DTE_Field_InputControl div div label {
            padding-bottom: 0px !important;
            margin-left: 0px !important;
        }

        .modal.DTED.fade.modal-sm .modal-dialog .modal-content .DTE_Body.modal-body .DTE_Body_Content .form-horizontal .DTE_Form_Content .DTE_Field_Name_distinguish .DTE_Field_InputControl div div .form-check-input:checked {
            margin: 0px;
        }

        .modal.DTED.fade.modal-sm .modal-dialog .modal-content .DTE_Body.modal-body .DTE_Body_Content .form-horizontal .DTE_Form_Content .DTE_Field_Name_permission .DTE_Field_InputControl div.row {
            display: flex !important;
            align-items: center;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 445px;
            margin: auto;
        }

        .modal.DTED.fade.modal-sm .modal-dialog .modal-content .DTE_Body.modal-body .DTE_Body_Content .form-horizontal .DTE_Form_Content .DTE_Field_Name_permission .DTE_Field_InputControl div.row div {
            display: flex;
            align-items: flex-start;
            gap: 5px;
            max-width: 33%;
            padding: 0px;
        }

        .modal.DTED.fade.modal-sm .modal-dialog .modal-content .DTE_Body.modal-body .DTE_Body_Content .form-horizontal .DTE_Form_Content .DTE_Field_Name_permission .DTE_Field_InputControl div.row div label {
            padding-bottom: 0px !important;
            margin-left: 0px !important;
            font-size: 14px;
        }

        .card {
            --bs-card-spacer-x: 0 !important;
        }

        .important-label {
            color: #EC661A;
            font-weight: 700;
        }

        @media screen and (max-width: 768px) {
            div#bulletin-table_wrapper {
                position: relative;

            }

            div#bulletin-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
                width: 100%;
            }

            div#bulletin-table_filter label {
                width: 100%;
            }

            div#bulletin-table_filter input {
                width: 100%;
                margin: 0;
            }

            div#bulletin-table_length {
                margin-top: 0;
            }

            div#bulletin-table_wrapper .align-items-center {
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
            #bulletin-table{
                overflow-x: scroll;
                display: block;
             }
            }

        div.DTE div.editor_upload.noClear div.clearValue button {
            display: none !important;
        }


        div.DTE div.editor_upload.multi div.clearValue {
            display: none !important;
        }
    </style>
@stop

@section('js')
    <script src="{{ asset('vendor/vuexy/js/forms-editors.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/quill/katex.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];

            grid.on('click', 'button.editor-edit', function(e) {
                var tdElements = e.target.closest('tr');
                editor.edit(tdElements, {
                    title: '<?php echo trans('bulletin::msg.edit-record'); ?>',
                    buttons: [{
                            text: '<?php echo trans('bulletin::msg.cancellation'); ?>',
                            action: function() {
                                editor.close();
                            }
                        },
                        {
                            text: '<?php echo trans('bulletin::msg.addition'); ?>',
                            action: function() {
                                editor.submit();
                            }
                        }
                    ]
                });

                var container = document.querySelector('.DTE_Field_InputControl input')
                let title = tdElements.querySelector('td a').textContent.trim();
                let distinguish = tdElements.querySelector('td input');
                let distinguishValue = distinguish.value;
                let permissionContainer = tdElements.querySelector('.permissions');
                let permissionsString = permissionContainer.value;
                let permissions = JSON.parse(permissionsString);

                var checkBoxes = document.querySelectorAll('input[type="checkbox"]');
                var radioButtons = document.querySelectorAll('input[type="radio"][name="distinguish"]');
                container.value = title;
                radioButtons.forEach(function(radioButton) {
                    if (radioButton.value === distinguishValue) {
                        radioButton.checked = true;
                    }
                });

                checkBoxes.forEach(function(checkBox) {
                    if (permissions.includes(checkBox.value)) {
                        checkBox.checked = true;
                    }
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
