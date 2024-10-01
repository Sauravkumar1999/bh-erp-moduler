<link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/dropzone/dropzone.css') }}">
<style>
    .select2-container {
        width: 100% !important;
    }

    span.select2-selection.select2-selection--multiple {
        padding: 0.422rem 0.875rem;
        min-height: 40px;
    }

    .select2-container li.select2-selection__choice {
        margin: 0 5px !important;
    }

    ul.select2-selection__rendered {
        padding: 0 !important;
        display: flex !important;
        align-items: center;
    }

    .file-field {
        position: relative;
        width: 100%;
        display: flex;
        margin: 20px 0 0;
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

    .dz-message {
        margin: 42px 0px 0px 0px !important;
        font-weight: 500;
        font-size: 1rem;
        text-align: center;
    }

    .dz-message:before {
        top: 1rem;
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

    .inputmask {
        text-align: left !important;
    }

    .read-only {
        background-color: rgba(75, 70, 92, .08);
    }

    .popover-body ul {
        padding-left: 0.8rem;
    }

    .productimg{
        height: 130px;
    }

    @media screen and (max-width: 767px) {
        .productimg{
            height: 180px;
        }
    }
</style>
<div>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-4 ">
            <label for="product-name" class="form-label">{{ __('product::product.product-name') }}</label>
            <input id="product-name" type="text" name="product_name"
                value="{{ old('product_name', $product->product_name) }}"
                class="form-control @error('product_name') is-invalid @enderror"
                placeholder="{{ __('product::product.product-name') }}">
            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4 ">
            <label for="productcompany_id" class="form-label">{{ __('product::product.productcompany') }}</label>
            <select id="productcompany_id"
                class="form-select multipleSelect @error('productcompany_id') is-invalid @enderror"
                name="productcompany_id">
                <option value="">업체 선택</option>
                @foreach ($data['productcompany'] as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>
                        {{ $company->name }}</option>
                @endforeach
            </select>
            @error('productcompany_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4 ">
            <label class="form-label">{{ __('product::product.sales-authority') }}</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="sale_rights" type="radio" id="full-disclosure"
                        value="full_disclosure" @if ($product->sale_rights_disclosure === 'full') checked @endif>
                    <label class="form-check-label"
                        for="full-disclosure">{{ __('product::sale-rights.full-disclosure') }}</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" name="sale_rights" type="radio" id="select-company"
                        value="select_company" @if ($product->sale_rights_disclosure != 'full') checked @endif>
                    <label class="form-check-label"
                        for="select-company">{{ __('product::sale-rights.select-a-company') }}</label>
                </div>
            </div>
            @error('sale_rights')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <select class="form-select multipleSelect" name="company_id[]" id="company_id" multiple
                @if ($product->sale_rights_disclosure === 'full') disabled @endif>
                @if ($product->sale_rights_disclosure === 'partial')
                    @foreach ($data['companies'] as $company)
                        <option value="{{ $company->id }}"
                            {{ !$product->saleRights->isEmpty() ? (in_array($company->id, $product->saleRights->pluck('id')->toArray()) ? 'selected' : '') : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('company_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4 ">
            <label for="approval_rights-select"
                class="form-label">{{ __('product::product.approval-authority') }}</label>
            <select class="form-select multipleSelect  @error('approval_rights') is-invalid @enderror"
                name="approval_rights[]" multiple="multiple" id="approval_rights-select">
                <option value="all_user">Select All</option>
                @foreach ($data['users'] as $user)
                    <option value="{{ $user->id }}"
                        {{ !$product->approvalRights->isEmpty() ? (in_array($user->id, $product->approvalRights->pluck('id')->toArray()) ? 'selected' : '') : '' }}>
                        {{ $user->first_name . ' ' . $user->last_name }}
                    </option>
                @endforeach
            </select>
            @error('approval_rights')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label class="form-label">{{ __('product::product.fee-form') }}</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="commission_type"
                        @if ($product->commission_type === 'fixed-price') checked @endif id="fixed-price" value="fixed-price">
                    <label class="form-check-label"
                        for="fixed-price">{{ __('product::commission-type.fixed-price') }}</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" name="commission_type"
                        @if ($product->commission_type === 'with-ratio') checked @endif type="radio" id="with-ratio"
                        value="with-ratio">
                    <label class="form-check-label"
                        for="with-ratio">{{ __('product::commission-type.with-ratio') }}</label>
                </div>
            </div>
            @error('commission_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="price" class="form-label">{{ __('product::product.product-price') }}</label>
            <input id="price" type="text" name="product_price" value="{{ $product->product_price }}"
                class="form-control inputmask-normal @error('product_price') is-invalid @enderror" placeholder="숫자 입력">
            @error('product_price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-4 ">
            <label for="product_description"
                class="form-label">{{ __('product::product.product-description') }}</label>
            <textarea id="product_description" class="form-control @error('product_description') is-invalid @enderror"
                name="product_description" placeholder="내용을 입력해 주세요.">{{ $product->product_description }}</textarea>
            @error('product_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4 ">
            <label for="sales-commission" class="form-label">{{ __('product::product.bh-sales-commission') }}</label>
            
            <input id="sales-commission" value="{{ number_format((float) $product->bh_sale_commissions, 0) }}"
                name="bh_sale_commissions" placeholder="숫자 입력" type="text"
                class="form-control inputmask @error('bh_sale_commissions') is-invalid @enderror">
            @error('bh_sale_commissions')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        {{-- branch representative --}}
        <div class="form-group mb-4  custom-field-group">
            <label class="form-label">{{ __('product::product.commission') }}</label>
            <span data-bs-toggle="popover" data-custom-content="true" class="badge badge-center rounded-pill bg-label-secondary cursor-pointer"
                data-bs-placement="top" data-bs-content="{{ trans('product::product.commission-bubble') }}">
                <i class="fa-regular fa-question"></i>
            </span>

            @php
                $commissionData = $product->product_commissions;
            @endphp
            <div class="mb-3 row">
                <label for="representative_bp"
                    class="col-md-2 col-form-label">{{ __('product::product.branch-representative') }}</label>
                <div class="col-md-10">
                    <input class="form-control inputmask @error('bp') is-invalid @enderror" type="text"
                        value="{{ old('bp', sanitize_data($commissionData['normal']['commission_bp'])) }}"
                        name="bp" placeholder="숫자 입력" id="representative_bp">
                    @error('bp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="representative-ba"
                    class="col-md-2 col-form-label">{{ __('product::product.branch-agent') }}</label>
                <div class="col-md-10">
                    <input class="form-control inputmask @error('ba') is-invalid @enderror" type="text"
                        name="ba"
                        value="{{ old('ba', sanitize_data($commissionData['normal']['commission_ba'])) }}"
                        placeholder="숫자 입력" id="representative-ba">
                    @error('ba')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="headquarters-representative-md"
                    class="col-md-2 col-form-label">{{ __('product::product.managing-director') }}</label>
                <div class="col-md-10">
                    <input class="form-control inputmask @error('md') is-invalid @enderror" type="text"
                        name="md"
                        value="{{ old('md', sanitize_data($commissionData['normal']['commission_md'])) }}"
                        placeholder="숫자 입력" id="headquarters-representative-md">
                    @error('md')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="headquarters-representative-pmd"
                    class="col-md-2 col-form-label">{{ __('product::product.principal-managing-director') }}</label>
                <div class="col-md-10">
                    <input class="form-control inputmask @error('pmd') is-invalid @enderror" type="text"
                        name="pmd"
                        value="{{ old('pmd', sanitize_data($commissionData['normal']['commission_pmd'])) }}"
                        placeholder="숫자 입력" id="headquarters-representative-pmd">
                    @error('pmd')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- hedqurater --}}
        <div class="mb-4 custom-field-group gapy">
            <label class="form-label">{{ __('product::product.headquarters-representative-allowance') }}</label>
            <div class="form-group mb-4 ">
                <label for="branch-representative"
                    class="form-label fw-light">{{ __('product::product.managing-director') }}</label>
                <div class="bd-example">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input hqr_checkbox_inp"
                            {{ old('h_mdRadioOptions', $commissionData['headquarter']['md'] == 0 ? 'unapplied' : 'applied') === 'applied' ? 'checked' : '' }}
                            type="radio" name="h_mdRadioOptions" id="h_mdRadio1" value="applied">
                        <label class="form-check-label"
                            for="h_mdRadio1">{{ trans('Product::product.applied') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input hqr_checkbox_inp" type="radio" name="h_mdRadioOptions"
                            id="h_mdRadio2"
                            {{ old('h_mdRadioOptions', $commissionData['headquarter']['md'] == 0 ? 'unapplied' : 'applied') === 'unapplied' ? 'checked' : '' }}
                            value="unapplied">
                        <label class="form-check-label"
                            for="h_mdRadio2">{{ trans('Product::product.unapplied') }}</label>
                    </div>
                </div>
                <input class="form-control commission_type_placeholder inputmask @error('h_md') is-invalid @enderror"
                    type="text" name="h_md"
                    {{ old('h_mdRadioOptions', $commissionData['headquarter']['md'] == 0 ? 'unapplied' : 'applied') === 'unapplied' ? 'disabled' : '' }}
                    placeholder="{{ __('product::product.managing-director') }}"
                    value="{{ old('h_md', sanitize_data($commissionData['headquarter']['md'])) }}"
                    id="branch-representative">
                @error('h_md')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4 ">
                <label for="branch-representative"
                    class="form-label fw-light">{{ __('product::product.principal-managing-director') }}</label>
                <div class="bd-example">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input hqr_checkbox_inp" checked type="radio"
                            name="h_pmdRadioOptions" id="h_pmdRadio1"
                            {{ old('h_pmdRadioOptions', $commissionData['headquarter']['pmd'] == 0 ? 'unapplied' : 'applied') === 'applied' ? 'checked' : '' }}
                            value="applied">
                        <label class="form-check-label"
                            for="h_pmdRadio1">{{ trans('Product::product.applied') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input hqr_checkbox_inp" type="radio" name="h_pmdRadioOptions"
                            id="h_pmdRadio2"
                            {{ old('h_pmdRadioOptions', $commissionData['headquarter']['pmd'] == 0 ? 'unapplied' : 'applied') === 'unapplied' ? 'checked' : '' }}
                            value="unapplied">
                        <label class="form-check-label"
                            for="h_pmdRadio2">{{ trans('Product::product.unapplied') }}</label>
                    </div>
                </div>
                <input type="text" name="h_pmd" id="referral_bonus"
                    {{ old('h_pmdRadioOptions', $commissionData['headquarter']['pmd'] == 0 ? 'unapplied' : 'applied') === 'unapplied' ? 'disabled' : '' }}
                    class="form-control commission_type_placeholder inputmask @error('h_pmd') is-invalid @enderror"
                    placeholder="{{ __('product::product.principal-managing-director') }}"
                    value="{{ old('h_pmd', sanitize_data($commissionData['headquarter']['pmd'])) }}"
                    id="branch-representative">
                @error('h_pmd')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4 ">
                <label for="referral_bonus"
                    class="form-label fw-light">{{ __('product::product.referral-bonus') }}</label>
                <div class="bd-example">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input hqr_checkbox_inp" checked type="radio"
                            name="referral_bonusRadioOptions"
                            {{ old('referral_bonusRadioOptions', $product->referral_bonus == 0 ? 'unapplied' : 'applied') === 'applied' ? 'checked' : '' }}
                            id="referral_bonusRadio1" value="applied">
                        <label class="form-check-label"
                            for="referral_bonusRadio1">{{ trans('Product::product.applied') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input hqr_checkbox_inp" type="radio"
                            name="referral_bonusRadioOptions"
                            {{ old('referral_bonusRadioOptions', $product->referral_bonus == 0 ? 'unapplied' : 'applied') === 'unapplied' ? 'checked' : '' }}
                            id="referral_bonusRadio2" value="unapplied">
                        <label class="form-check-label"
                            for="referral_bonusRadio2">{{ trans('Product::product.unapplied') }}</label>
                    </div>
                </div>
                <input id="referral_bonus" name="referral_bonus"
                    {{ old('referral_bonusRadioOptions', $product->referral_bonus == 0 ? 'unapplied' : 'applied') === 'unapplied' ? 'disabled' : '' }}
                    value="{{ old('referral_bonus', $product->referral_bonus) }}"
                    placeholder="{{ __('product::product.referral-bonus') }}" type="text"
                    class="form-control commission_type_placeholder inputmask @error('referral_bonus') is-invalid @enderror">
                @error('referral_bonus')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group mb-4 ">
            <label for="other_fees" class="form-label">{{ __('product::product.other-fees') }}</label>
            <input id="other_fees" name="other_fees" value="{{ old('other_fees', $product->other_fees) }}"
                placeholder="문자+숫자 입력" type="text"
                class="form-control inputmask-normal @error('other_fees') is-invalid @enderror">
            @error('other_fees')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--div class="form-group mb-4 ">
            <label for="bh_operating_profit"
                class="form-label">{{ __('product::product.bh-operating-profit') }}</label>
            <input id="bh_operating_profit" name="bh_operating_profit"
                value="{{ old('bh_operating_profit', price_formatter($product->bh_operating_profit, 0, '', '')) }}"
                placeholder="숫자 입력" type="text"
                class="form-control inputmask @error('bh_operating_profit') is-invalid @enderror">
            @error('bh_operating_profit')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div-->

        <div class="form-group mb-4">
            <label for="user-select" class="form-label">{{ __('product::product.manager') }}</label>
            <select id="user-select" name="user_id" data-placeholder="담당자 선택"
                class="form-select bh-select2 @error('user_id') is-invalid @enderror">
                <option></option>
                @foreach ($data['users'] as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $product->user_id ? 'selected' : '' }}>
                        {{ $user->first_name . ' ' . $user->last_name . '(' . $user->code . ')' }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4">
            <label for="belong" class="form-label">{{ __('product::manager.belong') }}</label>
            <input id="belong" name="belong" value="{{ $product->user?->company?->name ?? 'N/A' }}" readonly
                type="text" class="form-control">
        </div>

        <div class="form-group mb-4">
            <label for="belong" class="form-label">{{ __('product::manager.name') }}</label>
            <input id="full_name" name="full_name" value="{{ $product->user?->first_name ?? 'N/A' }}" readonly
                type="text" class="form-control">
        </div>

        <div class="form-group mb-4">
            <label for="position" class="form-label">{{ __('product::manager.position') }}</label>
            <input id="position" name="position" value="{{ $product?->user?->roles[0]?->display_name ?? 'N/A' }}"
                readonly type="text" class="form-control">
        </div>
        <div class="form-group mb-4">
            <label for="contact" class="form-label">{{ __('product::manager.contact') }}</label>
            <input id="contact" name="contact" value="{{ $product->user?->contacts[0]?->telephone_1 ?? 'N/A' }}"
                readonly type="text" class="form-control">
        </div>

        <div class="form-group mb-4">
            <label for="email" class="form-label">{{ __('product::manager.email') }}</label>
            <input id="email" name="email" value="{{ $product->user?->email ?? 'N/A' }}" readonly
                type="text" class="form-control">
        </div>

        <div class="form-group mb-4 ">
            <label for="contact-notification"
                class="form-label">{{ __('product::product.contact-notification') }}</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="contact_notifications" type="radio" id="notification_on"
                        value="1" @if ($product->contact_notifications) checked @endif>
                    <label class="form-check-label" for="notification_on">on</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" name="contact_notifications" type="radio"
                        id="notification_off" value="0" @if (!$product->contact_notifications) checked @endif>
                    <label class="form-check-label" for="notification_off">off</label>
                </div>
            </div>
            @error('contact_notifications')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4 ">
            <label for="product-sale-authority" class="form-label">{{ __('product::product.sales-status') }}</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" name="sale_status" type="radio" id="normal" value="normal"
                        @if ($product->sale_status === 'normal') checked @endif>
                    <label class="form-check-label" for="normal">{{ __('product::product.normal') }}</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" name="sale_status" type="radio" id="pause" value="pause"
                        @if ($product->sale_status === 'pause') checked @endif>
                    <label class="form-check-label" for="pause">{{ __('product::product.pause') }}</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" name="sale_status" type="radio" id="stop-selling"
                        value="stop-selling" @if ($product->sale_status === 'stop-selling') checked @endif>
                    <label class="form-check-label"
                        for="stop-selling">{{ __('product::product.sales-discontinued') }}</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" name="sale_status" type="radio" id="onetime-sell"
                        value="onetime-sell" @if ($product->sale_status === 'onetime-sell') checked @endif>
                    <label class="form-check-label"
                        for="onetime-sell">{{ __('product::product.one-time-registration') }}</label>
                </div>
            </div>
            @error('sale_status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4 ">
            <label for="product-link" class="form-label">
                {{ __('product::product.link') }}
                <span data-bs-toggle="popover" class="badge badge-center rounded-pill bg-label-secondary cursor-pointer"
                    data-bs-placement="top" data-bs-content="{{ __('product::product.link') }}">
                    <i class="fa-regular fa-question"></i>
                </span>
            </label>
            <input id="product_link" name="main_url" value="{{ $product->main_url }}" placeholder="URL 입력"
                type="text" class="form-control @error('main_url') is-invalid @enderror">
            @error('main_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-4" id="url_params-div">
            <label for="url_params" class="form-label">
                {{ __('product::product.url-params') }}
                <span data-bs-toggle="popover" class="badge badge-center rounded-pill bg-label-secondary cursor-pointer"
                    data-bs-placement="top" data-bs-content="{{ __('product::product.url-params') }}">
                    <i class="fa-regular fa-question"></i>
                </span>
            </label>

            @if (!is_null($product->url_params) && count($product->url_params) > 0)
                <div class="row py-1">
                    <div class="col-10 col-md-11">
                        <input id="firsturl_params" name="url_params[]" placeholder="{{ __('product::product.url-params') }}"
                            type="text" class="form-control" value="{{ $product->url_params[0] }}">
                    </div>
                    <div class="col-1 col-md-1">
                        <button type="button" onclick="addInputField()" data-toggle="tooltip" data-placement="top"
                            title="Add More" class="btn btn-sm btn-light"><i
                                class="fa-solid fa-plus fs-4 text-success"></i></button>
                    </div>
                </div>
                @foreach ($product->url_params as $index => $que)
                    @if ($index > 0)
                        <div class="row mt-3">
                            <div class="col-5">
                                <input id="url_params{{ $index }}" name="url_params[]"
                                    placeholder="{{ __('product::product.url-params') }}" type="text"
                                    class="form-control" value="{{ $que }}">
                            </div>
                            <div class="col-1">
                                <button type="button" onclick="return this.parentElement.parentElement.remove()"
                                    class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top"
                                    title="Remove"><i class="fa-solid fa-minus fs-4 text-danger"></i></button>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="row py-1">
                    <div class="col-10 col-md-11">
                        <input id="url_params" name="url_params[]" placeholder="{{ __('product::product.url-params') }}"
                            type="text" class="form-control">
                    </div>
                    <div class="col-1 col-md-1">
                        <button type="button" onclick="addInputField()" data-toggle="tooltip" data-placement="top"
                            title="Add More" class="btn btn-sm btn-light"><i
                                class="fa-solid fa-plus fs-4 text-success"></i></button>
                    </div>
                </div>
            @endif

        </div>
        <div class="form-group mb-4 ">
            <label for="product-static-link" class="form-label">
                {{ __('product::product.static-link') }}
                <span data-bs-toggle="popover" class="badge badge-center rounded-pill bg-label-secondary cursor-pointer"
                    data-bs-placement="top" data-bs-content="{{ __('product::product.static-link') }}">
                    <i class="fa-regular fa-question"></i>
                </span>
            </label>
            <input id="product_static_link" name="url_1" value="{{ $product->url_1 }}"
                   placeholder="{{ __('product::product.static-link') }}" type="text"
                   class="form-control @error('url_1') is-invalid @enderror">
            @error('url_1')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group flex-wrap1">
            <label for="dropzone">{{ __('product::product.banner') }}</label>
            <div class="flex-wrap1 inner-wrap flex-direction">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="file-path-wrapper">
                            <img src="{{ $product->banner() }}" alt="IdCard" class="productimg mt-2 mb-4" width="100%">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4 mt-2">
                        <div class="dropzone" id="dropzone" product-id="{{ $product->id }}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group mb-4 ">
            <label for="sales-commission" class="form-label">{{ __('product::product.exposure-order') }}</label>
            <input id="sales-commission" name="exposer_order"
                value="{{ old('exposer_order', $product->exposer_order) }}" placeholder="순서 입력" type="text"
                class="form-control @error('exposer_order') is-invalid @enderror">
            @error('exposer_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="defaultFormControlHelp" class="form-text">
                <ul>
                    <li>{{ __('product::product.exposure-order-text-lower-case') }}</li>
                    <li>{{ __('product::product.negative-number-input-possible') }}</li>
                </ul>
            </div>
        </div>
        <div class="form-group text-center">
            <button type="submit"
                class="dt-button buttons-create btn btn-primary">{{ __('product::product.updation') }}</button>
            <a href="{{ route('admin.products.index') }}"
                class="dt-button buttons-create btn btn-outline-primary">{{ __('product::product.cancellation') }}</a>
        </div>
    </form>
</div>
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/input-mask/inputmask.js') }}"></script>

    <script>
        function addInputField() {
            var inputField = `<div class="row py-1">
                                <div class="col-10">
                                    <input id="url_params" name="url_params[]" placeholder="{{ __('product::product.url-params') }}"
                                        type="text" class="form-control">
                                </div>
                                <div class="col-1">
                                    <button type="button" onclick="return this.parentElement.parentElement.remove()" class="btn btn-sm btn-light" data-toggle="tooltip" data-placement="top" title="Remove"><i
                                            class="fa-solid fa-minus fs-4 text-danger"></i></button>
                                </div>
                                </div>`;
            $('#url_params-div').append(inputField);
        }
        document.addEventListener('livewire:load', function() {

            $('.multipleSelect').select2({
                placeholder: "{{ __('core::select-two.select-item') }}"
            })

            $('input[name="sale_rights"]').on('change', function() {
                var dropdown = $('#company_id');
                var selectedValue = $(this).val();
                if (selectedValue === 'full_disclosure') {
                    dropdown.not(this).val(null).trigger('change.select2');
                    dropdown.attr('disabled', true);
                    return;
                }
                dropdown.attr('disabled', false);

                if (selectedValue === 'select_company') {
                    var companies = {!! json_encode($data['companies']->pluck('name', 'id')) !!};
                    var selectedCompanies = {!! json_encode($product->saleRights) !!};
                    var selectedAuthority = {!! json_encode($product->sale_rights_disclosure) !!};
                    dropdown.empty();
                    var selectedCompanyIds = [];
                    for (let index = 0; index < selectedCompanies.length; index++) {
                        selectedCompanyIds.push(selectedCompanies[index]['id']);
                    }
                    $.each(companies, function(id, name) {
                        dropdown.append('<option value="' + id + '">' + name + '</option>');
                    });
                    if (selectedAuthority === 'partial') {
                        dropdown.val(selectedCompanyIds).trigger('change.select2');
                    }
                    dropdown.trigger('change.select2');
                }
            });

            $('.hqr_checkbox_inp').change(function() {
                let inp = $(this).parent().parent().next()
                if (this.value == 'applied') {
                    inp.prop('disabled', false)
                } else if (this.value == 'unapplied') {
                    inp.prop('disabled', true)
                }
            });

            var approvalValue = {!! json_encode($product->approval_rights_disclosure) !!}
            if (approvalValue === 'full') {
                $('#approval_rights-select').val(['all_user']).trigger('change');
            }

            $('#approval_rights-select').on('change', function() {
                var selectedValues = $(this).val();
                if (selectedValues && selectedValues.includes('all_user')) {
                    if (selectedValues.length > 1) {
                        $(this).val(['all_user']).trigger('change');
                    }
                }
            });

            let commission_type = $('input[name="commission_type"]:checked').val();
            if (commission_type === 'with-ratio') {
                $('.commission_type_placeholder').each((index, item) => {
                    $(item).attr('placeholder', '지급 %를 입력');
                })
            } else if (commission_type === 'fixed-price') {
                $('.commission_type_placeholder').each((index, item) => {
                    $(item).attr('placeholder', '금액 입력');
                })
            }

            $('input[name="commission_type"]').change(function() {
                var typeValue = $(this).val();
                if (typeValue === 'with-ratio') {
                    $('.commission_type_placeholder').each((index, item) => {
                        $(item).attr('placeholder', '지급 %를 입력');
                    })
                    $('.inputmask').inputmask({
                        alias: 'numeric',
                        min: 0,
                        max: 100,
                        digits: 2,
                        radixPoint: '.',
                        autoGroup: true,
                    });
                } else if (typeValue === 'fixed-price') {
                    $('.commission_type_placeholder').each((index, item) => {
                        $(item).attr('placeholder', '금액 입력');
                    })
                    $('.inputmask').inputmask({
                        alias: 'numeric',
                        digits: 2,
                        min: 0,
                        radixPoint: '.',
                        autoGroup: true,
                        groupSeparator: ','
                    });
                }
            });

            $('.read-only').on('click', function() {
                var typeValue = $('input[name="commission_type"]:checked').val();
                var $priceInput = $('#price');

                if (typeValue === 'with-ratio') {
                    $priceInput.css('background-color', 'rgba(75,70,92,.08)');
                }
            });

            $('.inputmask').inputmask({
                alias: 'numeric',
                digits: 2,
                min: 0,
                radixPoint: '.',
                autoGroup: true,
                @if ($product->commission_type === 'fixed-price')
                    groupSeparator: ',',
                @elseif ($product->commission_type === 'with-ratio')
                    max: 100
                @endif
            });

            $('.inputmask-normal').inputmask({
                alias: 'numeric',
                digits: 2,
                min: 0,
                radixPoint: '.',
                autoGroup: true,
                groupSeparator: ',',
                rightAlign: false
            });

            $('#user-select').change(function() {
                var selectedUserid = $(this).val();
                var url = "{{ route('admin.users.show', ':user') }}";
                url = url.replace(':user', selectedUserid);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        let userData = response.user;
                        $('#belong').val(userData?.company?.name ?? 'N/A');
                        $('#position').val(userData?.roles[0]?.display_name ?? 'N/A');
                        $('#contact').val(userData?.contacts[0].telephone_1 ?? 'N/A');
                        $('#email').val(userData?.email ?? 'N/A');
                        $('#full_name').val(userData?.first_name ?? 'N/A');
                    }
                });
            });

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
                url: "{{ route('admin.products.banner.update', $product) }}",
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
                        $('#banner_img').val(response.filename);
                    }
                },
                error: function(file, response) {
                    return false;
                }
            };

            
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');

            popoverTriggerList.forEach(function (popoverTrigger) {
                let popoverInstance = null;

                function createPopover() {
                    if (!popoverInstance) {
                        popoverInstance = new bootstrap.Popover(popoverTrigger, {
                            trigger: 'focus',
                            html: true,
                            content: function () {
                                if (popoverTrigger.getAttribute('data-custom-content') === 'true') {
                                    const content = popoverTrigger.getAttribute('data-bs-content');
                                    let contentArray = document.documentElement.lang !== 'en' ?
                                        content.split("E") : // Split the content by E character
                                        content.split('. '); // Split the content by period and space

                                    // Create a new content string with bullet points
                                    let newContent = '<ul>';
                                    contentArray.forEach(item => {
                                        newContent += `<li>${item}</li>`;
                                    });
                                    newContent += '</ul>';

                                    return newContent;
                                } else {
                                    // Return the content directly for popovers that do not need special formatting
                                    return popoverTrigger.getAttribute('data-bs-content');
                                }
                            }
                        });
                    }
                }

                popoverTrigger.addEventListener('click', function (event) {
                    createPopover(); // Ensure popover is created if not already

                    // Toggle popover display
                    if (popoverInstance._element.getAttribute('aria-describedby')) {
                        popoverInstance.hide();
                    } else {
                        popoverInstance.show();
                    }

                    event.stopPropagation(); // Prevent event from bubbling up
                });

                document.addEventListener('click', function (event) {
                    if (!popoverTrigger.contains(event.target) && popoverInstance && popoverInstance._element.getAttribute('aria-describedby')) {
                        popoverInstance.hide();
                    }
                });

                popoverTrigger.addEventListener('hidden.bs.popover', function () {
                    if (popoverInstance) {
                        popoverInstance.dispose();
                        popoverInstance = null; // Reset instance to ensure clean state
                    }
                });
            });
        });
    </script>
@endpush
