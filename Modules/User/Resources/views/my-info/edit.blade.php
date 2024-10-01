@extends('adminlte::page')

@section('title', __('user::user.my-info'))

@section('content_header')
@inject('niceVerifyService', 'Modules\Core\Services\NiceVerifyService')
<x-core-content-header :title="__('user::user.my-info')" :breadcrumbs="$breadcrumbs" />

@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/dropzone/dropzone.css') }}">
<style>
    h3 {
        font-size: 21px;
    }

    h2 {
        color: #000;
    }

    .form-control {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    label {
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .flex-wrap1 {
        display: flex;
        width: 100%;
        align-items: center;
    }

    .flex-wrap1 label {
        min-width: 220px;
        color: #000;
    }

    .inner-wrap {
        column-gap: 10px;
    }

    input#smallField {
        max-width: 20%;
    }

    .inner-wrap .post_code {
        width: 20%;
    }

    /* .btn-primary {
                                                                                                                                                                                                                            color: #fff;
                                                                                                                                                                                                                            background-color: #007bff;
                                                                                                                                                                                                                            border-color: #007bff;
                                                                                                                                                                                                                        } */
    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .text-center {
        text-align: center;
    }

    .space-between {
        justify-content: space-between;
    }

    .box-wrap {
        box-shadow: 1px 5px 17px rgb(0 0 0 / 20%);
        padding: 14px 24px;
        border-radius: 7px;
        margin: 14px 0px;
        background: #fff;
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

    .file-field input[type="file"] {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 0;
        margin: 0;
        cursor: pointer;
        filter: alpha(opacity=0);
        opacity: 0;
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

    .file-field input.file-path {
        width: 97%;
        height: 26px;
        /* padding-left: 12px; */
        border-radius: 5px;
    }

    .file-field .file-path-wrapper img {
        height: 100%;
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

    /*.file-field .btn {
                 background-color: transparent;
                 color: #000;
                 border: 1px solid #ced4da;
                 min-height: 38px;
            }*/

    .address .file-field {
        width: auto !important;
    }

    form.box-wrap .text-center button[type="submit"] {
        width: 100px;
        margin-top: 24px;
    }

    form.box-wrap h3 {
        font-weight: 600;
        color: #000;
    }

    .disabled {
        background-color: #EEEEEE !important;
    }

    .dz-message {
         margin: 42px 0px 0px 0px !important;
        font-weight: 500;
        font-size: 1rem;
        text-align: center;
    }

    .dz-message:before {
        top: 1rem;
    }

    .invalid-feedback {
        font-size: 10px !important;
    }

    .membership-section {
        display: flex;
        gap: 20px;
    }

    .membership-section .checkbox-section {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .membership-section .checkbox-section label {
        min-width: unset;
        width: max-content;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .membership-section input[type=checkbox]+label {
        display: flex;
        margin: 0.2em;
        cursor: pointer;
        padding: 0.2em;
        font-family: 'Arial'
    }

    .membership-section input[type=checkbox] {
        display: none;
    }

    .membership-section input[type=checkbox]+label:before {
        content: "\2714";
        border: 0.1em solid #000;
        border-radius: 0.2em;
        display: inline-block;
        width: 20px;
        height: 20px;
        padding-left: 3px;
        padding-top: 0px;
        margin-right: 0.2em;
        vertical-align: bottom;
        color: transparent;
        transition: .2s;
    }

    .membership-section input[type=checkbox]+label:active:before {
        transform: scale(0);
    }

    .membership-section input[type=checkbox]:checked+label:before {
        background-color: #ED820A;
        border-color: #ED820A;
        color: #fff;
    }

    .membership-section input[type=checkbox]:disabled+label:before {
        transform: scale(1);
        border-color: #aaa;
    }

    .membership-section input[type=checkbox]:checked:disabled+label:before {
        transform: scale(1);
        background-color: #F7C28F;
        border-color: #F7C28F;
    }

    .profilephoto{
        height: 130px;
    }

    .common_icon{
        border-radius: 100px;
        border: 1px solid #9A9A9A;
        width: 29px;
        height: 28px;
        padding: 5px;
    }

    @media screen and (max-width: 767px) {
        .edit-flex {
            flex-direction: column;
            align-items: start !important;
        }

        .file-field .file-path-wrapper img {
            height: 80%;
        }

        .flex-wrap1 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .flex-wrap1 .btn-group {
            display: flex;
            flex-direction: column;
            align-items: space-between;
            justify-content: space-between;
            gap: 5px;
            margin-top: 5px;

        }

        .flex-wrap1 .btn-group a {
            border-radius: 7px !important;
        }

        .profilephoto{
            height: 180px;
        }
    }
</style>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- <h2 class="flex-wrap1 space-between">@lang('user::user.my-information')</h2> -->
        <form class="box-wrap" action="{{ route('admin.my-info.update', $user) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <h3 class="flex-wrap1 space-between">@lang('user::user.basic-additional-info')
                <div class="btn-group">
                    <a href="#" onclick="downloadQRCode()" class="btn btn-primary">
                        @lang('user::user.download-qr-code')
                    </a>
                    <a href="{{ route('sales.page', $user->code) }}" class="btn btn-primary">
                        @lang('user::user.business-card')
                    </a>
                </div>
            </h3>
            <div class="form-group flex-wrap1 edit-flex">
                <label for="name">@lang('user::user.name')</label>
                <div class="w-100">
                    <input type="text" class="form-control disabled @error('first_name') is-invalid @enderror" id="name" name="first_name" placeholder="공태웅" value="{{ $user->first_name }}" readonly>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group flex-wrap1 edit-flex address">
                <label for="homePage">@lang('user::user.home-address')</label>
                <div class="w-100">
                    <div class="flex-wrap1 inner-wrap ">
                        <input type="text" class="form-control disabled" id="homePage" placeholder="{{ route('sales.page', 'B62408') }}" value="{{ sales_person_url($user->code) }}" readonly>
                        <div class="file-field">
                            <div data-url="{{ sales_person_url($user->code) }}" id="copy_url">
                                <div class="btn btn-label-secondary waves-effect">
                                    <span><i class="ti ti-copy"></i>@lang('user::user.copy')</span>
                                </div>
                            </div>
                            <div data-url="{{ sales_person_url($user->code) }}" id="copied_url">
                                <div class="btn btn-label-secondary waves-effect">
                                    <svg version="1.1" width="15" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 58 58" xml:space="preserve">
                                        <circle style="  fill:#6576ff; " cx="25" cy="25" r="25"></circle>
                                        <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="38,15 22,33 12,25 "></polyline>
                                    </svg>
                                    <span><i class="ti ti-copy-check"></i>@lang('user::user.copy')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group flex-wrap1 edit-flex">
                <label for="code">@lang('user::user.code')</label>
                <div class="w-100">
                    <input type="text" class="form-control disabled @error('code') is-invalid @enderror" id="code" name="code" placeholder="B62408" value="{{ $user->code }}" readonly>
                    @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @if (setting('royal_membership_active', 1))
            <div class="form-group flex-wrap1 edit-flex">
                <label for="code">@lang('user::user.membership')</label>

                <div class="membership-section">
                    <div class="checkbox-section">
                        
                        <label for="royal">
                        <img class="user_badge_header" src="{{ asset('images/paid-icon-header.svg') }}" alt="paid" class="img-fluid">
                            @lang('user::user.royal')
                        </label>
                        @php
                        $path = '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />';
                        if (is_royal_member()){
                        $path = '<path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="#EC661A" />';
                        }
                        @endphp
                        
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check-filled" width="30" height="26" viewBox="0 0 24 24" stroke-width="1.5" stroke="#EC661A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            
                            {!! $path !!}
                        </svg>
                    </div>
                    <div class="checkbox-section">
                        <label for="common">
                        <img class="common_icon" src="{{ asset('images/winner_gray.png') }}" alt="paid" class="img-fluid">
                        @lang('user::user.common')</label>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle" width="30" height="26" viewBox="0 0 24 24" stroke-width="1.5" stroke="#EC661A" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            @php
                            $path = '<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />';
                        if (!is_royal_member()){
                        $path = '<path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="#EC661A" />';
                        }
                        @endphp
                            {!! $path !!}
                        </svg>
                    </div>
                </div>
            </div>
            <div class="form-group flex-wrap1 edit-flex">
                <label for="code">@lang('user::user.royal-membership-period')</label>

                <div class="w-100">
                    @php
                    $membershipPeriod='잔여일 : 0일';
                    if(is_royal_member()){
                    $membershipPeriod = formatDate(user()->start_date).' ~ '.formatDate(user()->end_date).' / 잔여일 : '.remainingDays(user()->end_date).'일';
                    }
                    @endphp
                    <input type="text" class="form-control disabled @error('code') is-invalid @enderror" value="{{$membershipPeriod }}" readonly>
                </div>
            </div>
            <div class="form-group flex-wrap1 edit-flex">
                <label for="code">@lang('user::user.royal-membership-benefits')</label>

                <div class="w-100">
                    <p class="m-0">@lang('user::user.royal-membership-benefits-text')</p>
                </div>
            </div>
            @endif
            <div class="form-group flex-wrap1 edit-flex">
                <label for="code">{{ __('user::user.company-name') }}</label>
                <div class="w-100">
                    <input type="text" class="form-control disabled @error('company_id') is-invalid @enderror" id="company_id" name="company_id" placeholder="{{ __('user::user.company-name') }}" value="{{ $user->company->name ?? 'N/A' }}" readonly>
                    @error('company_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group flex-wrap1 edit-flex">
                <label for="code">{{ __('user::user.role-type') }}</label>
                <div class="w-100">
                    <input type="text" class="form-control disabled @error('company_id') is-invalid @enderror" id="company_id" name="company_id" placeholder="{{ __('user::user.company-name') }}" value="{{ $user->roles->first()->display_name ?? 'N/A' }}" readonly>
                    @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group flex-wrap1 edit-flex">
                <label for="password">@lang('user::user.new-password')</label>
                <div class="input-group has-validation">
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('adminlte::adminlte.password') }}">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="form-group flex-wrap1 edit-flex">
                <label for="confirmPassword">@lang('user::user.new-pass-confirmation')</label>
                <div class="w-100">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" name="password_confirmation" placeholder="Confirm password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="flex-wrap1 inner-wrap edit-flex">
                <div class="form-group flex-wrap1 edit-flex">
                    <label for="bank_id">@lang('user::user.bank-information')</label>
                    <div class="w-100">
                        <div class="input-group has-validation">
                            <select class="form-control @error('bank_id') is-invalid @enderror select2item" id="bank_id" name="bank_id">
                                <option value="" disabled selected>@lang('user::user.select-bank')</option>
                                @foreach ($data['banks'] as $bank)
                                <option value="{{ $bank->id }}" @if ($bank->id == $user->bank_id) selected @endif>
                                    {{ $bank->display_name }}
                                </option>
                                @endforeach
                            </select>
                            @error('bank_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group flex-wrap1 edit-flex">
                    <label for="bank_account_no">@lang('user::user.account-number')</label>
                    <div class="w-100">
                        <input type="text" class="form-control @error('bank_account_no') is-invalid @enderror" id="bank_account_no" name="bank_account_no" placeholder="Enter bank account no" value="{{ $user->bank_account_no }}">
                        @error('bank_account_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group flex-wrap1 edit-flex">
                <label for="dropzone">@lang('user::user.id-card-copy')</label>
                <div class="flex-wrap1 inner-wrap flex-direction">
                    <div class="">
                        <div class="row">
                            <div class="col-12 col-md-4 mb-3 mb-md-0">
                               <div class="file-path-wrapper">
                                    <img src="{{ $user->idCard() }}" alt="IdCard" class="profilephoto" style="width: 120px; height: 120px;">
                                </div>
                            </div>
                            <div class="col-12 col-md-8 mb-4">
                                <div class="dropzone" id="dropzone"></div>
                            </div>
                        </div>
                    </div>
                    <p>@lang('user::user.error-file')<span>@lang('user::user.error-file-msg')</span></p>
                </div>
            </div>

            @php($contact = $user->contacts->first())
            
            <div class="form-group flex-wrap1 edit-flex">
                <label for="post_code">@lang('user::user.address')</label>
                <div class="flex-wrap1 inner-wrap  edit-flex">
                    <div class="post_code w-100 mb-2">
                        <input type="text" class="form-control disabled @error('post_code') is-invalid @enderror" name="post_code" id="post_code" placeholder="06044" value="{{ $contact ? $contact->post_code : '' }}" readonly>
                        @error('post_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-100 mb-2">
                        <input type="text" class="form-control disabled @error('address') is-invalid @enderror" name="address" id="address" placeholder="30298서울 강남구 논현동" value="{{ $contact ? $contact->address : '' }}" readonly>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="file-field  mb-2">
                        <div onclick="FindPostcode()" class="btn btn-label-secondary waves-effect w-100">
                            <span>@lang('user::user.address-search')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group flex-wrap1 edit-flex">
                <label for="address_detail">@lang('user::user.address-details')</label>
                <div class="w-100">
                    <input type="text" class="form-control @error('address_detail') is-invalid @enderror" id="address_detail" name="address_detail" placeholder="Address" value="{{ $contact ? $contact->address_detail : '' }}">
                    @error('address_detail')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group flex-wrap1 edit-flex">
                <label for="telephone_1">@lang('user::user.mobile-number')</label>
                <div class="w-100">
                    <div class="d-flex gap-2">
                        <input type="text" class="form-control disabled @error('telephone_1') is-invalid @enderror" id="telephone_1" name="telephone_1" placeholder="konggoon@naver.com" value="{{ $contact ? $contact->telephone_1 : '' }}" readonly>
                        <button type="button" id="mobile-auth" class="btn btn-primary waves-effect waves-light text-nowrap">{{trans('user::role.update')}}</button>
                        <input type="hidden" name="nice-data">
                    </div>
                    @error('telephone_1')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group flex-wrap1 edit-flex">
                <label for="email">@lang('user::user.email')</label>
                <div class="w-100">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="@" value="{{ $user->email }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">@lang('user::user.save-info')</button>
            </div>
            
        </form>
        @php ($niceVerifyService->setReturnURL(route('nice-verify.success')))
        @php ($niceVerifyService->setErrorURL(route('nice-verify.fail')))
        {!! $niceVerifyService->initNiceForm() !!}
    </div>
</div>


@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script>
    $(document).ready(function() {
        let nice_status = false;
        var $temp = $("<input>");

        var $copyUrlButton = $('#copy_url');
        var $copiedUrlButton = $('#copied_url');
        $copiedUrlButton.css('display', 'none');

        $copyUrlButton.on('click', function(e) {
            e.preventDefault();

            $("body").append($temp);
            $temp.val($(this).attr('data-url')).select();
            document.execCommand("copy");
            $temp.remove();
            $copyUrlButton.css('display', 'none');
            $copiedUrlButton.css('display', 'block');
        });

        $copiedUrlButton.on('click', function(e) {
            e.preventDefault();
            $("body").append($temp);
            $temp.val($(this).attr('data-url')).select();
            document.execCommand("copy");
            $temp.remove();
            $copiedUrlButton.css('display', 'none');
            $copyUrlButton.css('display', 'block');
        });
        setTimeout(() => {
            $('.alert').hide();
        }, 2000);


        //Nice Auth
        $('#mobile-auth').on('click', function() {
                nicePhoneVerify();
        });
    });

    function nicePhoneVerifyCallback(args) {
            let {
                name,
                gender,
                mobile_no,
                birthdate
            } = args
            if (name != '') {
                verify_phone(mobile_no,function(res){
                    if (res.success) {
                        Swal.fire({
                            text: "{{trans('user::user.duplicate-number')}}",
                            icon: "info",
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: 'check-button'
                            }
                        }).then((result) => {
                           return;
                        });
                    }else{
                        let url = "{{ route('update-phone') }}";
                        let formData = new FormData();
                        formData.append("phone_number",  mobile_no)
                        console.log('mobile_no', mobile_no)
                        formData.append("user_id",  '{{user()->id}}')
                        $.ajax({
                        type: "POST",
                        url: url,
                        data: formData, // Send serialized form data
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                $('#telephone_1').val(mobile_no);
                            }else{
                                Swal.fire({
                                    text: "{{trans('user::user.number-not-update')}}",
                                    icon: "error",
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: 'check-b utton'
                                    }
                                }).then((result) => {
                                return;
                                });
                            }
                        }
                    });
                    }
                })
                // $('#telephone_1').val(mobile_no);
                nice_status = true
            } else {
                Swal.fire({
                    title: "인증성공!",
                    text: "본인인증에 실패하였습니다.",
                    icon: "error",
                });
            }

    }
    
    function verify_phone(number,callback) {
        let url = "{{ route('verify-phone') }}";
        let formData = new FormData();
        formData.append("phone_number",  number)
        $.ajax({
            type: "POST",
            url: url,
            data: formData, // Send serialized form data
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                if (typeof callback === 'function') {
                    callback(response);
                }
            }
        });

    }

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
        url: '{{ route('admin.my-info.idcard-update', $user) }}',
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
        /*removedfile: function(file)
        {
            var name = file.upload.filename;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('content')
                },
                type: 'POST',
                url: '',
                data: {filename: name, '_token':$('input[name="_token"]').val()},
                success: function (data){
                },
                error: function(e) {
                }});
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },*/

        success: function(file, response) {
        },
        error: function(file, response) {
            return false;
        }
    };
    $('.select2item').select2({
        placeholder: "Select-Item"
    });



    function downloadQRCode() {
        let p2u_url = 'https://p2u.kr/bbs/register.php?bhid={{ $user->code }}';
        let qr = new QRious({
            value: p2u_url,
            size: 400,
        });
        let dataURL = qr.toDataURL('image/jpeg');
        let filename = ' P2U-QR.jpg';
        const a = document.createElement('a');
        document.body.appendChild(a);
        const url = window.URL.createObjectURL(dataURItoBlob(dataURL));
        a.href = url;
        a.download = filename;
        a.click();
        setTimeout(() => {
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        }, 0)
    }

    function dataURItoBlob(dataURI) {
        var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
        var binary = atob(dataURI.split(',')[1]);
        var array = [];
        for (var i = 0; i < binary.length; i++) {
            array.push(binary.charCodeAt(i));
        }
        return new Blob([new Uint8Array(array)], {
            type: mime
        });
    }
</script>
@stop