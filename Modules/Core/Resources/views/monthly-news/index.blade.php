@extends('adminlte::page')

@section('title', 'Monthly News Settings')

@section('content_header')

    <x-core-content-header :title="__('core::core.monthly-news')" :breadcrumbs="$breadcrumbs"/>
    <style>
        .container .image-preview {
            margin: auto;
        }
        .container .image-preview img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>

@stop

@section('content')

    <x-adminlte-card theme="primary" theme-mode="outline">
        <div class="container d-flex justify-content-center">
            <div class="p-3 d-flex justify-content-between gap-5 align-items-center">
                <div class="row">
                    @if (setting('monthly-news-img'))
                        <div class="col-12 col-md-6 mb-4">
                            <div class="image-preview">
                                <img src="{{ route('media.file.display', ['filename' => setting('monthly-news-img')]) }}" alt="Monthly News Image" class="img-fluid">
                            </div>
                        </div>
                    @endif
                        <div class="col-12 col-md-6">
                            <div class="file-container">
                                <label class="my-2" for="dropzone">Monthly News Image</label>
                                <div class="dropzone" id="dropzone">
                                    <input type="hidden" name="banner" id="monthly-news-img">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        {!! $dataTable->table() !!}

    </x-adminlte-card>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/dropzone/dropzone.css') }}">
    <style>
        .select2-container{
            z-index: 10000;
        }
        .card{
            --bs-card-spacer-x: 0 !important;
        }
        @media screen and (max-width: 767px) {
            div#monthlyNews-table_length{
                margin-top: 0;
            }
            div#monthlyNews-table_wrapper .align-items-center {
                margin-top: 10px;
                margin-bottom: 30px;
                justify-content: space-between !important;
            }
            div#monthlyNews-table_filter,
            div#monthlyNews-table_filter label,
            div#monthlyNews-table_filter input {
                width: 100%;
                margin-right: 0;
                margin-bottom: 0;
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
    <script type="text/javascript" src="{{asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/input-mask/inputmask.js') }}"></script>
    <script type="text/javascript" src="{{asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/vendor/datatables/editor/js/editor.select2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function () {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
            // Edit record
            grid.on('click', 'button.editor-edit', function (e) {
                e.preventDefault();

                editor.edit(e.target.closest('tr'), {
                    title: 'Edit record',
                    buttons: 'Update'
                });
            });
            // Delete a record
            grid.on('click', 'button.editor-delete', function (e) {
                e.preventDefault();

                editor.remove(e.target.closest('tr'), {
                    title: '{{ trans('core::modal.delete-title') }}',
                    message: '{{ trans('core::modal.delete-message') }}',
                    buttons: '{{ trans('core::modal.delete') }}',
                });
            });
        });
    </script>


    <script>
        // ! Don't change it unless you really know what you are doing
        const previewTemplate = `<div class="dz-preview dz-file-preview">
            <div class="dz-details">
              <div class="dz-thumbnail">
                <img data-dz-thumbnail>
                <span class="dz-nopreview">No preview</span>
                <div class="dz-success-mark"></div>
                <div class="dz-error-mark"></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                </div>
              </div><!--
              <div class="dz-filename" data-dz-name></div>
              <div class="dz-size" data-dz-size></div>-->
            </div>
            </div>`;

            Dropzone.options.dropzone = {
                url: "{{ route('admin.monthly-news.image.store') }}",
                maxFilesize: 12,
                previewTemplate: previewTemplate,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function(file, response) {

                    if (response && response.filename) {
                        var uploadedFileName = response.filename;
                        $('#monthly-news-img').val(response.filename);
                    }
                },
                error: function(file, response) {
                    return false;
                }
            };
    </script>
@stop
