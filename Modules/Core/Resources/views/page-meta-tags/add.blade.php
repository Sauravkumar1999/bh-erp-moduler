@extends('adminlte::page')
@section('title', __('core::page-meta.create'))
@section('content_header')
    <x-core-content-header :title="__('core::page-meta.create')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/dropzone/dropzone.css') }}">
@stop
@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        <div>
            <form action="{{ route('admin.page-meta-tags.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4">
                    <label for="page_url" class="form-label">{{ __('core::page-meta.page-url') }}</label>
                    <input id="page_url" type="text" name="page_url" value="{{ old('page_url') }}"
                        class="form-control @error('page_url') is-invalid @enderror"
                        placeholder="{{ __('core::page-meta.page-url') }}">
                    @error('page_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label class="form-label">{{ __('core::page-meta.status') }}</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="status" type="radio" id="status-active" value="active"
                                {{ old('status') == 'active' || !old('status') ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="status-active">{{ __('core::page-meta.status-active') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" name="status" type="radio" id="status-inactive"
                                value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                            <label class="form-check-label"
                                for="status-inactive">{{ __('core::page-meta.status-inactive') }}</label>
                        </div>
                    </div>
                    @error('sale_rights')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="url_params" class="form-label">{{ __('core::page-meta.meta-information') }}</label>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('core::page-meta.property') }}</th>
                                        <th scope="col">{{ __('core::page-meta.content') }}</th>
                                        <th scope="col">{{ __('core::page-meta.add-remove') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="url_params-div">
                                    <tr>
                                        <td>
                                            <input name="property[]" placeholder="{{ __('core::page-meta.property') }}"
                                                type="text" class="form-control">
                                        </td>
                                        <td>
                                            <input name="content[]" placeholder="{{ __('core::page-meta.content') }}"
                                                type="text" class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" onclick="addInputField()" data-toggle="tooltip"
                                                data-placement="top" title="Add More" class="btn btn-sm btn-light"><i
                                                    class="fa-solid fa-plus fs-4 text-success"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group flex-wrap1">
                    <label for="dropzone">{{ __('core::page-meta.og-image') }}</label>
                    <div class="flex-wrap1 inner-wrap flex-direction">
                        <div class="file-field">
                            <div class="file-path-wrapper">
                            </div>
                            <div class="dropzone" id="dropzone">
                                <input type="hidden" name="og_image" value="{{ old('og_image') }}" id="og_image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-end mt-2">
                    <button type="submit"
                        class="dt-button buttons-create btn btn-primary">{{ __('core::page-meta.submit') }}</button>
                </div>
            </form>
        </div>
    </x-adminlte-card>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script>
        // ! Don't change it unless you really know what you are doings
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
            url: "{{ route('admin.page-meta-tags.image.store') }}",
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
                    $('#og_image').val(response.filename);
                }
            },
            error: function(file, response) {
                return false;
            }
        };

        function addInputField() {
            var inputField = `<tr>
                                <td>
                                    <input name="property[]"
                                        placeholder="{{ __('core::page-meta.property') }}" type="text"
                                        class="form-control">
                                </td>
                                <td>
                                    <input name="content[]"
                                        placeholder="{{ __('core::page-meta.content') }}" type="text"
                                        class="form-control">
                                </td>
                                <td>
                                    <button type="button" onclick="return this.parentElement.parentElement.remove()" data-toggle="tooltip" data-placement="top"
                                    title="Add More" class="btn btn-sm btn-light"><i class="fa-solid fa-minus fs-4 text-danger"></i></button>
                                </td>
                              </tr>`;
            $('#url_params-div').append(inputField);
        }
    </script>
@stop