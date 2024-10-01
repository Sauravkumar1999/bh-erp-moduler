@extends('adminlte::page')

@section('title', __('user::user.my-homepage-manage'))

@section('content_header')

    <x-core-content-header :title="__('user::user.my-homepage-manage')" :breadcrumbs="$breadcrumbs" />

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/vuexy/vendor/libs/quill/katex.css') }}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/dropzone/dropzone.css') }}">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f7fa;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 7px;
            box-shadow: 0px 0px 4px 5px #97979717 !important;
        }

        .main-heading {
            margin-bottom: 15px;
            font-size: 24px;
            font-family: Pretendard;
            color: #2B2B2B !important;
            font-weight: 600;
        }

        .form-check-input {
            border: 1px solid #EC661A !important;

        }

        .form-check-input:checked {
            background-color: #EC661A;
            border-color: #EC661A;
        }

        .form-label {
            color: #2B2B2B !important;
            font-size: 16px;
            font-family: Pretendard;
            margin-bottom: 0px;
            font-weight: 600;

        }

        .sections-form {
            font-size: 16px;
            color: #2B2B2B !important;
            font-weight: 600;
            margin-bottom: 5px;
            font-family: Pretendard;
        }

        .btn-grey {
            padding: 10px 10px !important;
            color: #4D4D4D !important;
            background: #f2f1f1 !important;
            border-radius: 7px;
            border: 1px solid #dbdade !important;
            font-family: Pretendard;
            font-weight: 500;
        }

        .input-fields {
            border: 1px solid #dbdade !important;
            font-size: 16px !important;
            font-family: Pretendard;
            color: #4D4D4D !important;
            font-weight: 400;
            padding: 10px 10px !important;
            border-radius: 7px;
        }

        .input-fields::placeholder {
            color: #ABABAB;
        }

        .para-label {
            font-size: 16px !important;
            color: #4D4D4D;
            margin-top: 10px;
            font-family: Pretendard;
            margin-bottom: 0px;
            font-weight: 600;
        }

        table.table-borderless tr th {
            border-bottom: 1px solid #dbdade !important;
            background-color: #f4fbfb !important;
            padding: 10px 20px !important;
            text-align: center;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 600;
        }

        table tbody td {
            padding: 10px 20px !important;
            text-align: center;
            color: #2B2B2B;
            font-family: Pretendard;
            font-size: 16px;
            font-weight: 400;
        }

        table tbody td {
            border-bottom: 1px solid #dbdade;
        }

        table tbody tr:last-child td {
            border-bottom: none !important;
        }

        table tbody td svg {
            fill: #2B2B2B;
        }

        .table-border-radius {
            border-radius: 7px !important;
        }

        .table-scroll {
            border: 1px solid #dbdade;
            border-radius: 7px;
            overflow: hidden;
        }

        .logo_shadow {
            text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25), 0px 4px 4px rgba(0, 0, 0, 0.25);
            font-family: Pretendard;
            font-size: 16px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
        }

        .flex-direction {
            flex-direction: column;
            justify-content: start;
            align-items: self-start;
        }

        .flex-direction p {
            margin-top: 12px;
        }

        .flex-direction p span {
            color: red;
        }

        .file-field {
            position: relative;
            width: 100%;
            display: flex;
        }

        .file-field span {
            cursor: pointer;
            white-space: nowrap;
            font-size: 14px;
            margin-right: 0;
            padding: 0px 12px;
        }

        .file-field .file-path-wrapper {
            height: 7rem;
            overflow: hidden;
            width: 50%;
            display: flex;
            align-items: center;
            gap: 15px;
            justify-content: center;
        }


        .file-field .file-path-wrapper img {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        .validate {
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            background-color: transparent;
            border: 1px solid #ced4da;
            border-radius: 0;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }
        .dz-message {
            margin: 2rem 0 0rem;
            font-weight: 500;
            text-align: center;
        }

        .dz-message:before {
            top: 1rem;
        }

        .invalid-feedback {
            font-size: 10px !important;
        }

        @media screen and (max-width: 767px){
            /* .file-field{
                flex-wrap: wrap
            } */
            .file-field .file-path-wrapper {
                min-width: 40%;
            }
            div#dropzone {
                transform: scale(0.85);
                margin-left: -10px;
                padding: 0;
            }
            .file-field span {
                margin-top: 72px;
                display: block;
            }
        }
    </style>
@stop


@section('content')

    <section class="container-fluid p-3">
        <div class="form-container p-3">
            <form action="{{ route('admin.my-info.manageupdate', $user) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <p class="sections-form logo_shadow">@lang('user::manage-user.logo')</p>
                        <a href="{{ route('sales.page', $user->code) }}"
                            class="btn btn-primary">@lang('user::user.business-card')</a>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">@lang('user::manage-user.image-registration')</label>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <div class="d-flex gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bb" id="gridRadios1" value="1"
                                {{ (isset($userSetting->image_register) && $userSetting->image_register) ? 'checked' : 'checked' }}>
                                <label class="form-check-label"> @lang('user::manage-user.radio-on') </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bb" id="gridRadios2" value="0"
                                {{ (isset($userSetting->image_register) && !$userSetting->image_register) ? 'checked' : '' }}>
                                <label class="form-check-label"> @lang('user::manage-user.radio-off') </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="flex-wrap1 inner-wrap flex-direction">
                            <div class="file-field row">
                                <div class="file-path-wrapper mx-auto col-sm-12 col-md-6">
                                    {{-- <img src="{{ asset('images/digi-logo.png') }}" alt="salesPersonImage" class=""> --}}
                                    <img src="{{ $user->salesPersonImage() }}" alt="salesPersonImage" class="">
                                </div>
                                <div class="dropzone mx-auto col-sm-12 col-md-6" id="dropzone"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 mb-2">
                        <label for="registration" class="form-label">@lang('user::manage-user.text-registration')</label>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2 h-100 align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="name_status" id="gridRadios1"
                                    value="1" {{ old('name_status') == '1' ? 'checked' :  ((isset($userSetting->text_register) && $userSetting->text_register) ? 'checked' : 'checked' )}} >
                                <label class="form-check-label" for="gridRadios1"> @lang('user::manage-user.radio-on') </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="name_status" id="gridRadios1"
                                    value="0" {{ old('name_status') == '0' ? 'checked' : ((isset($userSetting->text_register) && !$userSetting->text_register) ? 'checked' : '' )}}>
                                <label class="form-check-label" for="gridRadios1"> @lang('user::manage-user.radio-off') </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 ps-1">
                        <input type="text" placeholder="@lang('user::manage-user.text-registration-placeholder')" class="form-control input-fields" id="characters"
                            name="text_registration" value="{{ isset($userSetting->text_registration) ? $userSetting->text_registration : old('text_registration') }}">
                        @error('text_registration')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <p class="para-label" id="error_msg" style=""> @lang('user::manage-user.characters') </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 ">
                        <label for="contact_number" class="form-label mb-2">@lang('user::manage-user.contact')</label>
                        <input type="tel" placeholder="@lang('user::manage-user.contact-placeholder')" value="{{isset($userSetting->telephone) ? $userSetting->telephone : old('contact_number') }}"
                            class="form-control input-fields" id="contact_number" name="contact_number">

                        @error('contact_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 ">
                        <label for="contact_email" class="form-label  mb-2">@lang('user::manage-user.email')</label>
                        <input type="email" placeholder="@lang('user::manage-user.email-placeholder')"
                            value="{{ isset($userSetting->email) ? $userSetting->email : $user->email }}" class="form-control input-fields"
                            id="contact_email" name="contact_email" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="sections-form">@lang('user::manage-user.my-profile')</p>
                    </div>
                    <div class="col-md-12 ">
                        <label for="text" class="form-label  mb-2">@lang('user::manage-user.text')</label>
                    </div>
                    <div class="col-md-12">
                        <textarea name="portfolio" id="quill-editor" cols="10" rows="10" class="form-control">{!! old('portfolio') ?: (isset($userSetting->portfolio) ? $userSetting->portfolio : '') !!}</textarea>
                    </div>
                    @error('portfolio')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="sections-form">@lang('user::manage-user.sns')</p>
                    </div>
                    <div class="row mb-2 pe-0">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">@lang('user::manage-user.facebook')</label>
                        </div>
                        @php
                            $snsData = isset($userSetting->sns) ? json_decode($userSetting->sns) : null;
                        @endphp
                        <div class="col-md-2">
                            <div class="d-flex gap-2 h-100 align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fa_status" id="gridRadios1_on"
                                        value="1" {{ old('fa_status') == '0' ? 'checked' : (isset($snsData->facebook->status) && $snsData->facebook->status == 1 ? 'checked' : 'checked') }}>
                                    <label class="form-check-label" for="gridRadios1_on"> @lang('user::manage-user.radio-on') </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="fa_status" id="gridRadios2_off"
                                        value="0" {{ old('fa_status') == '0' ? 'checked' :  (isset($snsData->facebook->status) && $snsData->facebook->status == 0 ? 'checked' : '' )}}>
                                    <label class="form-check-label" for="gridRadios2_off"> @lang('user::manage-user.radio-off') </label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-10 pe-0">
                            <input type="text" placeholder="@lang('user::manage-user.sns-placeholder')" class="form-control input-fields"
                                id="facebook_url" name="facebook_url" value="{{isset($snsData->facebook->url) ? $snsData->facebook->url : ''}}">

                            @error('facebook_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2 pe-0">
                        <div class="col-md-12">
                            <label for="instagram" class="form-label">@lang('user::manage-user.instagram')</label>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex gap-2 h-100 align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="in_status" id="instaGridRadios1_on"
                                        value="1" {{ old('in_status') == '0' ? 'checked' :  (isset($snsData->instagram->status) && $snsData->instagram->status == 1 ? 'checked' : 'checked') }} >
                                    <label class="form-check-label" for="gridRadios1"> @lang('user::manage-user.radio-on') </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="in_status" id="instGridRadios1_off"
                                        value="0" {{old('in_status') == '0' ? 'checked' : (isset($snsData->instagram->status) && $snsData->instagram->status == 0 ? 'checked' : '' )}}>
                                    <label class="form-check-label" for="gridRadios1"> @lang('user::manage-user.radio-off') </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 pe-0">
                            <input type="text" placeholder="@lang('user::manage-user.sns-placeholder')" class="form-control input-fields"
                                id="instagram_url" name="instagram_url" value="{{ isset($snsData->instagram->url) ? $snsData->instagram->url  : '' }}">

                            @error('instagram_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2 pe-0">
                        <div class="col-md-12">
                            <label for="kakaotalk" class="form-label">@lang('user::manage-user.kakaotalk')</label>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex gap-2 h-100 align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ko_status" id="gridRadios8"
                                        value="1" {{ old('ko_status') == '0' ? 'checked' : (isset($snsData->kakaotalk->status) && $snsData->kakaotalk->status == 1 ? 'checked' : 'checked' )}}>
                                    <label class="form-check-label" for="gridRadios1"> @lang('user::manage-user.radio-on') </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ko_status" id="gridRadios8"
                                        value="0" {{ old('ko_status') == '0' ? 'checked' : (isset($snsData->kakaotalk->status) && $snsData->kakaotalk->status == 0 ? 'checked' : '' )}}>
                                    <label class="form-check-label" for="gridRadios1"> @lang('user::manage-user.radio-off') </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-10 pe-0">
                            <input type="text" placeholder="@lang('user::manage-user.sns-placeholder')" class="form-control input-fields"
                                id="kakaotalk_url" name="kakaotalk_url" value="{{ isset($snsData->kakaotalk->url)  ? $snsData->kakaotalk->url : '' }}">

                            @error('kakaotalk_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2 pe-0">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">@lang('user::manage-user.blog')</label>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex gap-2 h-100 align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bl_status" id="gridRadios7"
                                        value="1" {{ old('bl_status') == '0' ? 'checked' :  (isset($snsData->blog->status) && $snsData->blog->status == 1 ? 'checked' : 'checked' )}}>
                                    <label class="form-check-label" for="gridRadios7"> @lang('user::manage-user.radio-on') </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bl_status" id="gridRadios7"
                                        value="0" {{ old('bl_status') == '0' ? 'checked' : (isset($snsData->blog->status) && $snsData->blog->status == 0 ? 'checked' : '' )}}>
                                    <label class="form-check-label" for="gridRadios7"> @lang('user::manage-user.radio-off') </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 pe-0">
                            <input type="text" placeholder="@lang('user::manage-user.sns-placeholder')" class="form-control input-fields" id="blog_url"
                                name="blog_url" value="{{ isset($snsData->blog->url) ? $snsData->blog->url : '' }}">

                            @error('blog_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="sections-form">@lang('user::manage-user.advertisement')</p>
                    </div>
                    <div class="col-md-12">

                        <div class="table-scroll">
                            <table class="table table-responsive  table-border-radius">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('user::manage-user.order-exposure')</th>
                                        <th scope="col">@lang('user::manage-user.no')</th>
                                        <th scope="col">@lang('user::manage-user.product-name')</th>
                                        {{-- <th scope="col">@lang('user::manage-user.item-exposure')</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="sortable-table-body">
                                    @php
                                       // $sortedRights = $user->productRights->sortBy('pivot.odr_app');
                                         $sortedRights = $user->company ? merge_user_settings($user, $user->company->productRights) : collect();
                                    @endphp
                                    @forelse($sortedRights as $key => $item)
                                        <tr>
                                            <td>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                                                </svg>
                                            </td>
                                            <td data- data-odr_app="{{ $item['odr_app'] }}"
{{--                                                data-user_id="{{ $item['pivot']['rightable_id'] }}"--}}
                                                data-product_id="{{ $item['id'] }}">
                                                {{ $item['odr_app'] }}
                                            </td>
                                            <td>{{ $item['product_name'] }}</td>
                                            {{-- <td>
                                                <div class="d-flex gap-3 justify-content-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="prod_expose_{{ $item['id'] }}" id="prod_on"
                                                            value="on"
                                                            @if ($item['exposure'] == 1) checked @endif>
                                                        <label class="form-check-label" for="prod_on"> on </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="prod_expose_{{ $item['id'] }}" id="prod_off"
                                                            value="off"
                                                            @if ($item['exposure'] == 0) checked @endif>
                                                        <label class="form-check-label" for="prod_off"> off </label>
                                                    </div>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                        <button class="btn btn-primary" id="submit_manage">@lang('user::manage-user.save-info')</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script src="{{ asset('vendor/vuexy/vendor/libs/quill/katex.js') }}"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('vendor/vuexy/js/forms-editors.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script>
        $(document).ready(function() {
            $('#characters').on('input', function() {
                var inputValue = $(this).val();
                if (inputValue.length > 25) {
                    $(this).val(inputValue.slice(0, 25));
                    $('#error_msg').show();
                    $('#submit_manage').prop('disabled', true);
                } else {
                    $('#error_msg').hide();
                    $('#submit_manage').prop('disabled', false);
                }
            });

            var tableBody = document.getElementById('sortable-table-body');
            new Sortable(tableBody, {
                animation: 150,
                onUpdate: function(evt) {
                    var rows = tableBody.getElementsByTagName('tr');
                    var newData = [];
                    for (var i = 0; i < rows.length; i++) {
                        var item = {
                           // id: rows[i].querySelector('td[data-user_id]').getAttribute('data-user_id'),
                            product_id: rows[i].querySelector('td[data-product_id]').getAttribute(
                                'data-product_id'),
                            order: i + 1
                        };
                        var radioButtons = rows[i].querySelectorAll('input[name^="prod_expose_"]');
                        for (var j = 0; j < radioButtons.length; j++) {
                            if (radioButtons[j].checked) {
                                item['exposure'] = radioButtons[j].value === 'on';
                                break;
                            }
                        }
                        newData.push(item);
                    }
                    updateOrder(newData);
                }
            });
        });


        function updateOrder(newData) {
            fetch('{{ route('admin.my-info.updateOrder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        newData: newData
                    }),
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        console.error('Failed to update order');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#quill-editor').nextAll().remove();
            var el = $('#quill-editor'),
                id = 'quilleditor',
                val = el.val(),
                editor_height = 100;
            var div = $('<div/>').attr('id', id).css('height', editor_height + 'px').html(val);
            el.addClass('d-none');
            el.parent().append(div);

            var quill = new Quill('#' + id, {
                modules: {
                    formula: true,
                    toolbar: fullToolbar
                },
                theme: 'snow'
            });
            quill.on('text-change', function() {
                var quillContent = quill.root.innerHTML;
                $('#quill-editor').val(quillContent);
            });

            $('#select_file').click(function() {
                document.getElementById('fileInput').click();
            })

            $('#fileInput').change(function() {
                var fileName = $(this).val().split('\\').pop();
                $('#select_file_name').val(fileName);
            });

        });
    </script>

    <script>
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
            url: '{{ route('admin.my-info.salesperson-image', $user) }}',
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
            },
            error: function(file, response) {
                return false;
            }
        };
    </script>
@stop
