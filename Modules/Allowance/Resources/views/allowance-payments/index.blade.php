@extends('adminlte::page')
@section('title', __('allowance::allowance.allowance-payments'))
@section('content_header')
    <x-core-content-header :title="__('allowance::allowance.allowance-payments')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/css/rtl/managemodal.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/katex.css') }}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .pdfobject-container {
            height: 30rem;
            border: 1rem solid rgba(0, 0, 0, .1);
        }
        .accordion-body::-webkit-scrollbar {
          width: 6px;
         }
         .accordion-body::-webkit-scrollbar-thumb {
             background: #ec661a;
             border-radius: 5px;
         }
         .accordion-body::-webkit-scrollbar-thumb:hover {
             background: #818181;
         }

         div.dataTables_wrapper div.dataTables_filter input[type="search"] {
            margin-left: 0px !important;
         }


         /* .card .card-body{
            padding: 0px 0px 0px;
        } */
        @media screen and (max-width: 767px) {
            .card .card-body {
                padding: 0px 0px 0px;
            }
            div#allowance-payments-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
                width: 100%;
            }
            div#allowance-payments-table_filter label {
                width: 100%;
            }
            div#allowance-payments-table_wrapper .align-items-center {
                margin-top: 10px;
                margin-bottom: 30px;
                justify-content: space-between !important;
            }
            div#allowance-payments-table_length {
                margin-top: 0;
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
        }

        div.DTE div.editor_upload.noClear div.clearValue button {
            display: none !important;
        }


        div.DTE div.editor_upload.multi div.clearValue {
            display: none !important;
        }
    </style>
@stop

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>
    <!-------------------------------------Show Image modal------------------------------------------------------>
    <div class="modal fade pdf-modal-img" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">@lang('company::company.contract')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="Image" class="w-100 h-100">
                    <div id="showContract"></div>
                </div>
                <div class="modal-footer text-center">
                    <a href="javascript:void(0)" id="checkUrl" class="btn btn-secondary">@lang('company::company.check')</a>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------Show Image modal------------------------------------------------------>
@stop


@section('js')
    <script src="{{ asset('vendor/vuexy/js/forms-editors.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/quill/katex.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js" integrity="sha512-lDL6DD6x4foKuSTkRUKIMQJAoisDeojVPXknggl4fZWMr2/M/hMiKLs6sqUvxP/T2zXdrDMbLJ0/ru8QSZrnoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
            grid.on('click', 'button.editor-edit', function(e) {
                var tdElements = e.target.closest('tr');
                editor.edit(tdElements, {
                    title: '<?php echo trans('allowance::allowance.edit-record'); ?>',
                    buttons: [{
                            text: '<?php echo trans('core::modal.cancellation'); ?>',
                            action: function() {
                                editor.close();
                            }
                        },
                        {
                            text: '<?php echo trans('core::modal.save'); ?>',
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

            window.openContractModal = function(basename) {
            $('#showContract').empty();
            let url = '{{ route('media.file.display', ':file') }}';
            url = url.replace(':file', basename);

            $.ajax({
                url: url,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(result, status, xhr) {
                    let contentType = xhr.getResponseHeader('Content-Type');

                    let blob = new Blob([result], {
                        type: contentType
                    });

                    let images = '{!! json_encode(config('mediable.aggregate_types.' . \Plank\Mediable\Media::TYPE_IMAGE . '.mime_types')) !!}';
                    let pdf = '{!! json_encode(config('mediable.aggregate_types.' . \Plank\Mediable\Media::TYPE_PDF . '.mime_types')) !!}';

                    let embedURL = URL.createObjectURL(blob);

                    if (images.includes(contentType)) {
                        $('#imageModal .modal-body img').attr('src', embedURL).show();
                        $('#imageModal .modal-body object').hide();
                        $('#showContract').hide();
                    } else if (pdf.includes(contentType)) {
                        $('#showContract').show();
                        $('#imageModal .modal-body img').hide();
                        PDFObject.embed(embedURL, "#showContract");
                    }

                    $('#imageModal .modal-footer').show();
                    $('#imageModal').modal('show');
                },
                error: function(error) {
                    $('#imageModal .modal-body img').hide();
                    $('#showContract').text('{{ trans('company::company.no-contract-msg') }}');
                    $('#imageModal .modal-footer').hide();
                }
            });

        }

        // clear the upload buttons which has no text
        function cleanUploadClear() {

            document.querySelectorAll(".clearValue .btn-outline-secondary").forEach(el => {
                if (el.textContent === '') {
                    el.parentNode.style.display = "none";
                }
            });

        }
        })
    </script>
@stop

