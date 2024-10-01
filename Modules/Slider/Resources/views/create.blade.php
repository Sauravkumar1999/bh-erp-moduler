@extends('adminlte::page')
@section('title', __('slider::slider.create'))
@section('content_header')
    <x-core-content-header :title="__('slider::slider.create')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/katex.css') }}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="{{ asset('vendor/vuexy/vendor/libs/quill/katex.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <style>
        .tab-content {
            box-shadow: 0 0 !important;
        }

        .dz-message {
            margin: 0rem 0 3rem !important;
        }

        .tab-content {
            padding: 0 !important;
        }
    </style>
@stop
@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        <form action="{{ route('admin.slider.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="nav-align-left mb-4">
                <ul class="nav nav-pills me-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-slider" aria-controls="navs-pills-slider"
                            aria-selected="true">{{ trans('slider::slider.slider') }}</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-item" aria-controls="navs-pills-item"
                            aria-selected="false">{{ trans('slider::slider.item') }}</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-slider" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="slider-name">{{ trans('slider::slider.name') }}</label>
                                <input type="text" id="slider-name" name="slider-name" required class="form-control"
                                    placeholder="{{ trans('slider::slider.name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="slider-slug">{{ trans('slider::slider.slug') }}</label>
                                <input type="text" class="form-control" required name="slider-slug" id="slider-slug"
                                    placeholder="{{ trans('slider::slider.slug') }}" />
                                <div class="text-danger"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="switch switch-square switch-lg">
                                    <input type="checkbox" name="slider-status" class="switch-input" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"><i class="ti ti-check"></i></span>
                                        <span class="switch-off"><i class="ti ti-x"></i></span>
                                    </span>
                                    <span class="switch-label">{{ trans('slider::slider.status') }}</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"
                                    for="slider-description">{{ trans('slider::slider.description') }}</label>
                                <textarea name="slider-description" class="form-control" id="slider-description" rows="2"
                                    placeholder="{{ trans('slider::slider.description') }}"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-item" role="tabpanel">
                        <div id="input_section">
                            <div class="card my-2">
                                <div class="card-header d-flex justify-content-between">
                                    <label class="switch switch-square switch-lg">
                                        <input type="checkbox" name="item-status[]" class="switch-input" />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"><i class="ti ti-check"></i></span>
                                            <span class="switch-off"><i class="ti ti-x"></i></span>
                                        </span>
                                        <span class="switch-label">{{ trans('slider::slider.status') }}</span>
                                    </label>
                                    <button class="btn p-1" type="button" data-toggle="tooltip" data-placement="top"
                                        title="Remove This Item" onclick="removeItem(this)">
                                        <i class="fa-solid fa-xmark ti-sm text-danger"></i>
                                    </button>
                                </div>
                                <div class="card-body px-2">
                                    <div id="dynamic-form" class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label"
                                                for="item-name">{{ trans('slider::item.name') }}</label>
                                            <input type="text" name="item-name[]" id="item-name" class="form-control"
                                                placeholder="{{ trans('slider::item.name') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"
                                                for="item-title">{{ trans('slider::item.title') }}</label>
                                            <input type="text" name="item-title[]" id="item-title"
                                                class="form-control" placeholder="{{ trans('slider::item.title') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"
                                                for="item-caption">{{ trans('slider::item.caption') }}</label>
                                            <input type="text" class="form-control" name="item-caption[]"
                                                id="item-caption" placeholder="{{ trans('slider::item.caption') }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"
                                                for="item-url">{{ trans('slider::item.url') }}</label>
                                            <input type="text" class="form-control" name="item-url[]" id="item-url"
                                                placeholder="{{ trans('slider::item.url') }}" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label"
                                                for="item-custom_html">{{ trans('slider::item.custon-html') }}</label>
                                            <textarea name="item-custom_html[]" class="form-control" id="item-custom_html" rows="2"
                                                placeholder="{{ trans('slider::item.custon-html') }}"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group flex-wrap1">
                                                <label for="dropzone">{{ trans('slider::slider.image') }}</label>
                                                <div class="flex-wrap1 inner-wrap flex-direction">
                                                    <div class="file-field">
                                                        <div class="file-path-wrapper">
                                                        </div>
                                                        <div class="dropzone" id="dropzone">
                                                            <input type="hidden" name="item-image[]" id="item-image">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <button type="button" id="addDynamicFormBtn"
                                class="btn btn-label-primary">{{ trans('slider::slider.add-item') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-4 text-end">
                <button type="submit"
                    class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">{{ trans('slider::slider.submit') }}</button>
            </div>
        </form>
    </x-adminlte-card>
@stop
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        let previewTemplate =
            `<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-thumbnail"><img data-dz-thumbnail>`;
        previewTemplate +=
            `<span class="dz-nopreview">No preview</span><div class="dz-success-mark"></div><div class="dz-error-mark"></div>`
        previewTemplate += `<div class="dz-error-message"><span data-dz-errormessage></span></div><div class="progress">`
        previewTemplate +=
            `<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>`
        previewTemplate += `</div></div></div></div>`

        // Function to create and initialize Dropzone
        function createDropzone(containerId) {
            new Dropzone('#' + containerId, {
                url: "{{ route('admin.slider.item.image.store') }}",
                maxFilesize: 12,
                previewTemplate: previewTemplate,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                sending: function(file, xhr, formData) {
                    formData.append("_token", "{{ csrf_token() }}");
                },
                success: function(file, response) {

                    if (response && response.filename) {
                        var uploadedFileName = response.filename;
                        $(`#item-image-${containerId}`).val(response.filename);
                    }
                },
                error: function(file, response) {
                    return false;
                }
            });
        }
        // Function to initialize Quill editor
        function initializeQuillEditor(formCounter) {
            $(`#item-custom_html-${formCounter}`).nextAll().remove();
            var el = $(`#item-custom_html-${formCounter}`),
                id = `quilleditor-${formCounter}`,
                val = el.val(),
                editor_height = 100;

            var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
            el.addClass('d-none');
            el.parent().append(div);

            var quill = new Quill('#' + id, {
                modules: {
                    formula: true,
                    toolbar: true
                },
                theme: 'snow'
            });
            quill.on('text-change', function() {
                var quillContent = quill.root.innerHTML;
                $(`#item-custom_html-${formCounter}`).val(quillContent);
            });
        }

        // Function to add dynamic form
        function addDynamicForm() {
            let formCounter = $('.card').length + 1;
            let dynamicForm = `<div class="card my-2">
                <div class="card-header d-flex justify-content-between">
                    <label class="switch switch-square switch-lg">
                        <input type="checkbox" name="item-status[]" class="switch-input" />
                        <span class="switch-toggle-slider">
                            <span class="switch-on"><i class="ti ti-check"></i></span>
                            <span class="switch-off"><i class="ti ti-x"></i></span>
                        </span>
                        <span class="switch-label">{{ trans('slider::slider.status') }}</span>
                    </label>
                    <button class="btn p-1" type="button" data-toggle="tooltip" data-placement="top"
                        title="Remove This Item" onclick="removeItem(this)">
                        <i class="fa-solid fa-xmark ti-sm text-danger"></i>
                        </button>
                </div>
            <div class="card-body">
            <div id="dynamic-form-${formCounter}" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="item-name-${formCounter}">{{ trans('slider::item.name') }}</label>
                        <input type="text" name="item-name[]" id="item-name-${formCounter}" class="form-control" placeholder="{{ trans('slider::item.name') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="item-title-${formCounter}">{{ trans('slider::item.title') }}</label>
                        <input type="text" name="item-title[]" id="item-title-${formCounter}" class="form-control" placeholder="{{ trans('slider::item.title') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="item-caption-${formCounter}">{{ trans('slider::item.caption') }}</label>
                        <input type="text" class="form-control" name="item-caption[]" id="item-caption-${formCounter}" placeholder="{{ trans('slider::item.caption') }}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="item-url-${formCounter}">{{ trans('slider::item.url') }}</label>
                        <input type="text" class="form-control" name="item-url[]" id="item-url-${formCounter}" placeholder="{{ trans('slider::item.url') }}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="item-custom_html-${formCounter}">{{ trans('slider::item.custon-html') }}</label>
                        <textarea name="item-custom_html[]" class="form-control" id="item-custom_html-${formCounter}" rows="2" placeholder="{{ trans('slider::item.custon-html') }}"></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group flex-wrap1">
                            <label for="dropzone-${formCounter}">{{ trans('slider::slider.image') }}</label>
                            <div class="flex-wrap1 inner-wrap flex-direction">
                                <div class="file-field">
                                    <div class="file-path-wrapper">
                                    </div>
                                    <div class="dropzone" id="dropzone-${formCounter}">
                                        <input type="hidden" name="item-image[]" id="item-image-dropzone-${formCounter}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>`;
            $('#input_section').append(dynamicForm);
            initializeDropzone(`dropzone-${formCounter}`);
            initializeQuillEditor(formCounter)
        }

        // Event listener for adding dynamic form
        // initializeQuillEditor(00)
        document.getElementById("addDynamicFormBtn").addEventListener("click", addDynamicForm);

        // Function to remove item
        function removeItem(button) {
            if (confirm('Sure To remove')) {
                button.parentElement.parentElement.remove()
            }
        }

        // Function to initialize Dropzone for dynamically added forms
        function initializeDropzone(containerId) {
            // Check if Dropzone is already attached to the element
            if (!$(containerId).hasClass("dz-clickable")) {
                createDropzone(containerId);
            }
        }
        $('input[name="slider-slug"]').on('input', function() {
            var inputValue = $(this).val();
            var sanitizedValue = inputValue.replace(/\s/g, '');
            $(this).val(sanitizedValue);
            var regex = /^\S*$/;
            if (!regex.test(inputValue)) {
                $('input[name="slider-slug"]').next().text('Spaces are not allowed in the slug.');
            } else {
                $('input[name="slider-slug"]').next().text('');
            }
        });
    </script>
    <script>
        new Dropzone('#dropzone', {
            url: "{{ route('admin.slider.item.image.store') }}",
            maxFilesize: 12,
            previewTemplate: previewTemplate,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            success: function(file, response) {
                if (response && response.filename) {
                    var uploadedFileName = response.filename;
                    $(`#item-image`).val(response.filename);
                }
            },
            error: function(file, response) {
                return false;
            }
        });
        $(`#item-custom_html`).nextAll().remove();
        var el = $(`#item-custom_html`),
            id = `quilleditor`,
            val = el.val(),
            editor_height = 100;

        var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
        el.addClass('d-none');
        el.parent().append(div);

        var quill = new Quill('#' + id, {
            modules: {
                formula: true,
                toolbar: true
            },
            theme: 'snow'
        });
        quill.on('text-change', function() {
            var quillContent = quill.root.innerHTML;
            $(`#item-custom_html`).val(quillContent);
        });
    </script>
@endpush
