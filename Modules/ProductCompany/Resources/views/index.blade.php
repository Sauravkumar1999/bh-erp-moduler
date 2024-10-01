@extends('adminlte::page')


@section('title', __('productcompany::productcompany.product-company'))

@section('content_header')

    <x-core-content-header :title="__('productcompany::productcompany.product-company')" :breadcrumbs="$breadcrumbs" />

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
                    <h5 class="modal-title" id="imageModalLabel">@lang('productcompany::productcompany.contract')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="Image" class="w-100 h-100">
                    <div id="showContract"></div>
                </div>
                <div class="modal-footer text-center">
                    <a href="javascript:void(0)" id="checkUrl" class="btn btn-secondary">@lang('productcompany::productcompany.check')</a>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------Show Image modal------------------------------------------------------>

    <div class="modal fade" id="company-details" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content company-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close-modal-button" data-dismiss="modal" onclick="closeModal()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table_div">
                        <table border="1" class="company-table">
                            <tr>
                                <td class="titles">@lang('productcompany::productcompany.business-name')</td>
                                <td id="business_name"></td>
                            </tr>

                            <tr>
                                <td class="titles">@lang('productcompany::productcompany.license-number')</td>
                                <td id="license_number"></td>
                            </tr>
                            <tr>

                                <td class="titles">@lang('productcompany::productcompany.address')</td>
                                <td id="address"></td>
                            </tr>

                        </table>
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-primary" id="compay_button">확인 </button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/css/rtl/managemodal.css') }}">

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

        .card {
            --bs-card-spacer-x: 0 !important;
        }

        #imageModal .modal-dialog {
            max-width: 400px;
            top: 50%;
            transform: translateY(-50%);
        }

        .pdfobject-container {
            height: 30rem;
            border: 1rem solid rgba(0, 0, 0, .1);
        }

        .pdf-modal-img .modal-header,
        .pdf-modal-img .modal-footer {
            justify-content: center;
        }

        .pdf-modal-img .modal-header .btn-close {
            transform: translate(0px, 0px) !important;
            background-color: rgba(92, 70, 70, 0.08);
            color: rgb(92, 70, 70);
            box-shadow: none;
        }

        .pdf-modal-img .modal-header h5 {
            color: rgba(43, 43, 43, 1);
            font-weight: 500;
            font-size: 24px;
        }

        .modal-footer .btn {
            background: rgba(236, 102, 26, 1) !important;
            color: #fff !important;
            box-shadow: none;
            border: #EC661A 1px solid;
        }

        div#showContract {
            text-align: center;
        }

        #company-details .modal-dialog {
            top: 50%;
            transform: translateY(-50%);
        }

        #company-details .modal-footer {
            padding: 0px 16px 16px;
            justify-content: center;
        }

        #company-details .modal-footer #compay_button {
            padding: 10px 40px;
        }

        span.business_name_button {
            text-decoration: underline;
        }

        @media screen and (max-width: 767px) {
            div#product-company-table_length {
                margin-top: 0;
            }
            div#product-company-table_wrapper .align-items-center {
                margin-bottom: 30px;
                justify-content: space-between !important;
            }
            div#product-company-table_filter ,
            div#product-company-table_filter label,
            div#product-company-table_filter input {
                width: 100%;
                margin-right: 0;
            }

            div#company-table_wrapper {
                position: relative;

            }

            div#company-table_filter {
                margin: 0;
                text-align: left;
                margin-bottom: 9px;
            }

            div#company-table_filter label {
                width: 100%;
            }

            div#company-table_filter input {
                width: 78%;
                margin: 0;
            }

            div#company-table_length {
                position: absolute;
                right: 0;
                top: 0;
                margin-top: 0;
            }

            div#company-table_wrapper .align-items-center {
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

        div.DTE div.editor_upload.noClear div.clearValue button {
            display: none !important;
        }


        div.DTE div.editor_upload.multi div.clearValue {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
            // Edit record
            $(document).on('click', 'button.editor-edit', function(e) {
                e.preventDefault();
                editor.edit(e.target.closest('tr'), {
                    title: '{{ trans('company::company.update') }}',
                    buttons: [{
                            text: '{{ trans('core::modal.cancellation') }}',
                            action: function() {
                                editor.close();
                            }
                        },
                        {
                            text: '{{ trans('core::modal.save') }}',
                            action: function() {
                                editor.submit();
                            }
                        }

                    ]
                });

                let container = $(editor.field('contract').node()).find('.rendered img');
                container.src = e.target.getAttribute('data-url');
                let status = e.target.getAttribute('data-status');
                let radioInputs = document.querySelectorAll('input[name="status"]');
                radioInputs.forEach(function(radioInput) {
                    if (radioInput.value === status) {
                        radioInput.checked = true;
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


            $(document).on("click", "span.business_name_button", function(e) {
                e.preventDefault();
                var row = grid.row($(this).closest('tr')).data();
                $('#business_name').text(row.business_name);
                $('#license_number').text(row.registration_number);
                $('#address').text(row.address);
                $('#company-details').modal('show');
            });
        });

        function closeModal() {
            $('#company-details').modal('hide');
        }

        function openContractModal(basename) {
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
                    $('#showContract').text('{{ trans('productcompany::productcompany.no-contract-msg') }}');
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
    </script>

@stop
