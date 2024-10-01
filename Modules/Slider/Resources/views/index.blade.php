@extends('adminlte::page')
@section('title', __('slider::slider.slider-management'))
@section('content_header')
    <x-core-content-header :title="__('slider::slider.slider-management')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <style>
         @media screen and (max-width: 767px) {
            .card .card-body {
                padding: 0px 0px 0px;
            }
            div#slider-table_length {
                margin-top: 0;
            }
            div#slider-table_wrapper .align-items-center {
                margin-bottom: 30px;
                justify-content: space-between !important;
            }
            #slider-table_wrapper .dt-buttons {
                height: 40px;
                font-size: 12px !important;
                text-align: right !important;
            }
            div#slider-table_filter,
            div#slider-table_filter input,
            div#slider-table_filter label {
                width: 100%;
                margin-right: 0;
            }
         }
    </style>
@stop
@section('content')
    <!-- Your existing content goes here -->
    <x-adminlte-card theme="primary" theme-mode="outline">
        {!! $dataTable->table() !!}
    </x-adminlte-card>
    <div class="modal fade" id="slider-data" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content company-content">
                <div class="modal-header">
                    <h5 class="text-dark">{{ trans('core::modal.delete-title') }}</h5>
                </div>
                <div class="modal-body">{{ trans('core::modal.delete-message') }}</div>
                <div class="modal-footer">
                    <button class="btn btn-primary delete-slider" data-clicked="false"
                        tabindex="0">{{ trans('core::modal.delete') }}</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dataTables.buttons.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.print.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
            let editor = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}-editor"]
            let grid = window.LaravelDataTables["{!! $dataTable->getTableAttribute('id') !!}"];
            grid.on('click', 'button.editor-delete', function(e) {
                e.preventDefault();
                var selectedSlidertid = $(this).attr('data-url');
                var url = "{{ route('admin.slider.delete', ':slider') }}";
                url = url.replace(':slider', selectedSlidertid);
                $('#slider-data').modal('show');
                $(document).on('click', '.delete-slider', function(e) {
                    e.preventDefault();
                    $(this).data('clicked', true);
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: "json",
                        success: function(response) {
                            window.LaravelDataTables["slider-table"].ajax.reload();
                            $('#slider-data').modal('hide');
                        }
                    });
                });
            });
        });
    </script>
@stop
