@extends('adminlte::page')

@section('title', trans('user::role.roles'))

@section('content_header')

<x-core-content-header :title="__('user::role.role-management')" :breadcrumbs="$breadcrumbs" />

@stop

@section('content')

<x-adminlte-card theme="primary" theme-mode="outline">

    {!! $dataTable->table() !!}

</x-adminlte-card>
<!-- Include the Livewire component -->
<livewire:user::auth.edit-role />
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
<link rel="stylesheet" href="{{asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/css/rtl/managemodal.css') }}">

{{-- <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css"> --}}
<link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/typography.css') }}" />
<link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/katex.css') }}" />
{{-- <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/editor.css') }}" /> --}}
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
    .card{
        --bs-card-spacer-x: 0 !important;
    }

    .note-toolbar {
        position: absolute!important;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #fff;
        border-top: 1px solid #ccc;
        padding: 5px;
        z-index: 1000;
    }

    #DTE_Field_list_1{
        display: none;
    }

    #DTE_Field_list_2{
        display: none;
    }

    .marker::before {
        content: '\2022';
        margin-right: 8px;
    }

    .DTE_Field.form-group.row.DTE_Field_Type_text.DTE_Field_Name_list_1,
    .DTE_Field.form-group.row.DTE_Field_Type_text.DTE_Field_Name_list_2
    {
        margin-left: 5px;
    }
    .DTE_Header_Content h5 {
        margin-top: -5px;
        font-weight: 600!important;
    }
    .DTE_Field label {
        font-weight: 600!important;
    }
 @media screen and (max-width: 767px){
    div#role-table_wrapper {
    position: relative;
}
div#role-table_filter {
    margin: 0;
    text-align: left;
    margin-bottom: 9px;
    width: 100%;
}
div#role-table_filter label {
    width: 100%;
}
div#role-table_filter input {
    width: 100%;
    margin: 0;
}
div#role-table_length {
    margin-top: 0;
}
div#role-table_wrapper .align-items-center {
    margin-bottom: 30px;
    justify-content: space-between !important;
}
div#role-table_wrapper button {
    padding-left: 10px;
    padding-right: 10px;
}
.DTE_Action_Create .DTE_Body {
    padding-bottom: 0px!important;
}

.modal.DTED.fade.show .modal-dialog{
    left: 0px !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
}
.modal .modal-header{
    justify-content: center;
}
.modal.DTED.fade.show .modal-dialog{
    left: 0px !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
    height: 90% !important;
}
.modal-backdrop{
    height: 90% !important;
    position: fixed !important;
    top: 11% !important;
}
.modal-dialog-centered{
    position: fixed;
    bottom: 0px;
    min-height: 90% !important;
    overflow-y: scroll;
}
.modal .modal-header{
    justify-content: center;
}
 }
</style>
@stop

@section('js')
{{-- toolbar  --}}
<script src="{{ asset('vendor/vuexy/js/forms-editors.js') }}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="{{asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js')}}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
<script src="{{ asset('vendor/vuexy/vendor/libs/quill/katex.js') }}"></script>
{{-- <script src="{{ asset('vendor/vuexy/vendor/libs/quill/quill.js') }}"></script> --}}
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


{!! $dataTable->scripts() !!}
<script>

    let tableId = "{!! $dataTable->getTableAttribute('id') !!}";

    $(document).ready(function() {

        let grid = window.LaravelDataTables[tableId];
        let editor = window.LaravelDataTables[tableId + "-editor"]

        //Edit event model
        grid.on('click', 'button.editor-edit', function(e) {
            e.preventDefault();
            editor.edit(e.target.closest('tr'), {
                title: '<?php echo trans('user::role.edit-role') ?>',
                buttons: [{
                    text:  '<?php echo trans('user::role.cancellation') ?>',
                    action: function() {
                        editor.close();
                    }
                },
                    {
                        text:  '<?php echo trans('user::role.update') ?>',
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

    });



    // livewire modal loaded
    window.addEventListener('modal-loaded', event => {
        $("#" + tableId + "_processing").hide();
    });

    // livewire modal closed
    window.addEventListener('modal-closed', event => {
        $("#" + tableId + "_processing").hide();
    });
</script>
<script>
    //Assign permissions
    function selectPermissions(element, name) {

        let checkboxes = $(`#chk_list_${name}`).find(':checkbox');

        if ($(element).prop('checked')) {
            $(`#chk_list_${name} :checkbox`).prop('checked', true);

            checkboxes.each(function() {
                window.livewire.emit('checkboxChecked', $(this).attr('id').split('_')[1]);
            });
        } else {
            $(`#chk_list_${name} :checkbox`).prop('checked', false);
            //$(`#chk_list_${name} :checkbox`).prop('checked', true);

            checkboxes.each(function() {
                window.livewire.emit('checkboxUnChecked', $(this).attr('id').split('_')[1]);
            });
        }
    }

    function selectOnePermission (ele, name) {
        checkboxes = $(`#chk_list_${name}`).find(':checkbox');

        let allChecked = true;

        checkboxes.each(function() {
            if (!$(this).prop('checked')) {
                allChecked = false;
                return false; // Exit the loop early since we found an unchecked checkbox
            }
        });

        if (allChecked) {
            window.livewire.emit('checkContainer', name);

        } else {
            window.livewire.emit('uncheckContainer', name);
        }

    }

    function loading() {
        $("#" + tableId + "_processing").css('z-index', '10000');
        $("#" + tableId + "_processing").show();
    }
</script>

<script>
</script>
@stop
