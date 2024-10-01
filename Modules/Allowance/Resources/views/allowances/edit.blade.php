@extends('adminlte::page')

@section('title', __('allowance::allowance.edit'))

@section('content_header')


    <div class="d-flex align-content-center">
        <a href="{{ route('admin.allowances.index') }}" class="link-primary mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M15 6.5L9 12.5L15 18.5" stroke="#646464" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <x-core-content-header :title="__('allowance::allowance.edit')" :breadcrumbs="$breadcrumbs" />
    </div>

@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/flatpickr/plugins/monthSelect/style.min.css') }}">
    <style>
        .readonly input {
            background-color: #f2f2f2;
        }

        .form-label {
            font-family: Pretendard;
            font-size: 15px !important;
            font-weight: 400;
            line-height: 18px;
            letter-spacing: 0px !important;
            text-align: left;

        }

        input::placeholder {
            font-family: Pretendard;
            font-size: 16px !important;
            font-weight: 400 !important;
            line-height: 24px !important;
            letter-spacing: 0px !important;
            text-align: left;

        }

        .form-select {
            color: #ABABAB !important;
        }

        .btn-primary {
            padding: 12px 40px !important;
        }

        .allowance-outline-btn {
            border: 1px solid #EC661A !important;
            color: #EC661A !important;
            padding: 12px 40px !important;
        }

        .inputmask {
            text-align: left !important;
        }
        .buttons{
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }
        @media screen and (max-width: 767px){
            .buttons{
                display: flex;
                align-items: center;
                justify-content: flex-end;
                gap: 10px;
            }
        }
    </style>
@stop

@section('content')
    <x-adminlte-card theme="primary" header-class="d-none" body-class="mt-4" theme-mode="outline">

        <form autocomplete="off" method="POST" action="{{ route('admin.allowances.update', $allowance) }}">
            @csrf
            @method('PUT')
            <div class="form-group mb-4 readonly">
                <label for="payment_month" class="form-label">{{ __('allowance::allowance.payment-month') }}</label>
                <input id="payment_month" name="payment_month" value="{{ old('payment_month', $allowance->payment_month) }}"
                    class="form-control @error('payment_month') is-invalid @enderror calendar"
                    placeholder="{{ __('allowance::allowance.payment-month') }}">
                @error('payment_month')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="" class="form-label">{{ __('allowance::allowance.member-name') }}</label>
                <select class="form-select memberSelect @error('member_id') is-invalid @enderror" id="member_id"
                    name="member_id" aria-label="Default select example">
                    <option value="">{{ __('allowance::allowance.member-name') }}</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}" @if ($member->id === $allowance->member_id) selected @endif>
                            {{ $member->first_name . ' ' . $member->last_name }}</option>
                    @endforeach
                </select>
                @error('member_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group mb-4 readonly">
                <label for="" class="form-label">{{ __('allowance::allowance.member-code') }}</label>
                <input id="code" name="" value="{{ $allowance->member?->code }}" class="form-control"
                    placeholder="{{ __('allowance::allowance.member-code') }}" readonly="readonly">
            </div>

            <div class="form-group mb-4 readonly">
                <label for="" class="form-label">{{ __('allowance::allowance.birth-date') }}</label>
                <input id="birth_date" name="" value="{{ $allowance->member?->dob }}" class="form-control"
                    placeholder="{{ __('allowance::allowance.birth-date') }}" readonly="readonly">
            </div>

            <div class="form-group mb-4 readonly">
                <label for="rank" class="form-label">{{ __('allowance::allowance.rank') }}</label>
                <input id="rank" name=""
                    value="{{ (isset($allowance->member->roles) && $allowance->member->roles->isNotEmpty()) ? $allowance->member->roles->first()->name : 'N/A' }}"
                    class="form-control" placeholder="{{ __('allowance::allowance.rank') }}" readonly="readonly">
            </div>

            <div class="form-group mb-4">
                <label for="commission" class="form-label">{{ __('allowance::allowance.commission') }}</label>
                <input id="commission" name="commission" value="{{ old('commission', $allowance->commission) }}" class="form-control deducted_amount inputmask" placeholder="{{ __('allowance::allowance.commission') }}">
            </div>

            <div class="form-group mb-4">
                <label for="referral_bonus" class="form-label">{{ __('allowance::allowance.referral-bonus') }}</label>
                <input id="referral_bonus" name="referral_bonus" value="{{ old('referral_bonus', $allowance->referral_bonus) }}" class="form-control deducted_amount inputmask" placeholder="{{ __('allowance::allowance.referral-bonus') }}">
            </div>


            <div class="form-group mb-4">
                <label for="headquarters_representative_allowance"
                    class="form-label">{{ __('allowance::allowance.headquarters-representative-allowance') }}</label>
                <input id="headquarters_representative_allowance" type="text"
                    name="headquarters_representative_allowance"
                    value="{{ old('headquarters_representative_allowance', $allowance->headquarters_representative_allowance) }}"
                    class="form-control deducted_amount @error('headquarters_representative_allowance') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.headquarters-representative-allowance') }}">
                @error('headquarters_representative_allowance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="organization_division_allowance"
                    class="form-label">{{ __('allowance::allowance.organization-division-allowance') }}</label>
                <input id="organization_division_allowance" type="text" name="organization_division_allowance"
                    value="{{ old('organization_division_allowance', $allowance->organization_division_allowance) }}"
                    class="form-control deducted_amount @error('organization_division_allowance') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.organization-division-allowance') }}">
                @error('organization_division_allowance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="policy_allowance" class="form-label">{{ __('allowance::allowance.policy-allowance') }}</label>
                <input id="policy_allowance" type="text" name="policy_allowance"
                    value="{{ old('policy_allowance', $allowance->policy_allowance) }}"
                    class="form-control deducted_amount @error('policy_allowance') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.policy-allowance') }}">
                @error('policy_allowance')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group mb-4">
                <label for="other_allowances" class="form-label">{{ __('allowance::allowance.other-allowances') }}</label>
                <input id="other_allowances" type="text" name="other_allowances"
                    value="{{ old('other_allowances', $allowance->other_allowances) }}"
                    class="form-control deducted_amount @error('other_allowances') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.other-allowances') }}">
                @error('other_allowances')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group mb-4">
                <label for="income_tax" class="form-label">{{ __('allowance::allowance.income-tax') }}</label>
                <input id="income_tax" type="text" name="income_tax"
                    value="{{ old('income_tax', $allowance->income_tax) }}"
                    class="form-control total_before deducted_amount @error('income_tax') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.income-tax') }}">
                @error('income_tax')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="resident_tax" class="form-label">{{ __('allowance::allowance.resident-tax') }}</label>
                <input id="resident_tax" type="text" name="resident_tax"
                    value="{{ old('resident_tax', $allowance->resident_tax) }}"
                    class="form-control total_before deducted_amount @error('resident_tax') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.resident-tax') }}">
                @error('resident_tax')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="year_end_settlement"
                    class="form-label">{{ __('allowance::allowance.year-end-settlement') }}</label>
                <input id="year_end_settlement" type="text" name="year_end_settlement"
                    value="{{ old('year_end_settlement', $allowance->year_end_settlement) }}"
                    class="form-control deducted_amount @error('year_end_settlement') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.year-end-settlement') }}">
                @error('year_end_settlement')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="other_deductions_1"
                    class="form-label">{{ __('allowance::allowance.other-deductions-i') }}</label>
                <input id="other_deductions_1" type="text" name="other_deductions_1"
                    value="{{ old('other_deductions_1', $allowance->other_deductions_1) }}"
                    class="form-control deduction deducted_amount @error('other_deductions_1') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.other-deductions-i') }}">
                @error('other_deductions_1')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4">
                <label for="other_deductions_2"
                    class="form-label">{{ __('allowance::allowance.other-deductions-ii') }}</label>
                <input id="other_deductions_2" type="text" name="other_deductions_2"
                    value="{{ old('other_deductions_2', $allowance->other_deductions_2) }}"
                    class="form-control deduction deducted_amount @error('other_deductions_2') is-invalid @enderror inputmask"
                    placeholder="{{ __('allowance::allowance.other-deductions-ii') }}">
                @error('other_deductions_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-4 readonly">
                <label for="total_deduction" class="form-label">{{ __('allowance::allowance.total-deduction') }}</label>
                <input id="total_deduction" name="total_deduction"
                    value="{{ old('total_deduction', $allowance->total_deduction) }}" class="form-control inputmask"
                    placeholder="{{ __('allowance::allowance.total-deduction') }}" readonly>
            </div>

            <div class="form-group mb-4 readonly">
                <label for="total_before_tax"
                    class="form-label">{{ __('allowance::allowance.total-before-tax') }}</label>
                <input id="total_before_tax" name="total_before_tax"
                    value="{{ old('total_before_tax', $allowance->total_before_tax) }}" class="form-control inputmask"
                    placeholder="{{ __('allowance::allowance.total-deduction') }}" readonly>
            </div>
            <div class="form-group mb-5 readonly">
                <label for="deducted_amount_received"
                    class="form-label">{{ __('allowance::allowance.deducted-amount-received') }}</label>
                <input id="deducted_amount_received" name="deducted_amount_received"
                    value="{{ old('deducted_amount_received', $allowance->deducted_amount_received) }}"
                    class="form-control inputmask"
                    placeholder="{{ __('allowance::allowance.deducted-amount-received') }}" readonly>
            </div>

            <div class="form-group text-center mb-4">
                <button type="submit" class="btn btn-primary">{{ __('allowance::allowance.addition') }}</button>
                <button type="button" onclick="window.location.href='{{ route('admin.allowances.index') }}'"
                    class="btn allowance-outline-btn">{{ __('allowance::allowance.cancellation') }}</button>
            </div>
        </form>
    </x-adminlte-card>
@stop
@section('js')
    <script type="text/javascript" src="{{ asset('/vendor/vuexy/js/flatpickr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/input-mask/inputmask.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js" integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/monthSelect/index.js"></script>
    <script>
        $(document).ready(function() {
            $(".calendar").flatpickr({
                plugins: [
                    new monthSelectPlugin({
                        // shorthand: true, //defaults to false
                        dateFormat: "F", //defaults to "F Y"
                        altFormat: "F", //defaults to "F Y"
                        theme: "light",
                    })
                ],
                dateFormat: "F",
                mode: "single",
                altInput: true,
                altFormat: "F",
                onChange: function(selectedDates, dateStr, instance) {
                    instance.setDate(dateStr, false);
                }
            })
            $('.inputmask').inputmask({
                alias: 'numeric',
                digits: 2,
                radixPoint: '.',
                autoGroup: true,
                groupSeparator: ','
            }).each(function() {
                let inputValue = $(this).val();
                if (inputValue.endsWith('.00')) {
                    inputValue = inputValue.slice(0, -3);
                    $(this).val(inputValue);
                }
            });

            $('#member_id').change(function() {
                var selectedUserid = $(this).val();
                if (selectedUserid != '') {
                    var url = "{{ route('admin.users.show', ':user') }}";
                    url = url.replace(':user', selectedUserid);
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "json",
                        success: function(response) {
                            let userData = response.user;
                            $('#code').val(userData?.code ?? 'N/A');
                            $('#rank').val(userData?.roles[0]?.display_name ?? 'N/A');
                            $('#birth_date').val(userData?.dob ?? 'N/A');
                        }
                    });
                    return
                }
                $('#code').val('');
                $('#rank').val('');
                $('#birth_date').val('');
            });
            $('.deducted_amount').on('keyup', function() {
                let totalSum = 0;
                $('.deducted_amount').each(function() {
                    totalSum += parseFloat($(this).val().replace(/,/g, '')) || 0;
                });
                $('#deducted_amount_received').val(totalSum.toFixed(2));
            });


            $('.total_before').on('keyup', function() {
                let totalSum = 0;
                $('.total_before').each(function() {
                    totalSum += parseInt($(this).val().replace(/,/g, ''), 10) || 0;
                });
                $('#total_before_tax').val(totalSum);
            });

            $('.deduction').on('keyup', function() {
                let totalSum = 0;
                $('.deduction').each(function() {
                    totalSum += parseInt($(this).val().replace(/,/g, ''), 10) || 0;
                });
                $('#total_deduction').val(totalSum);
            });
            $('.memberSelect').select2({
                placeholder: "Select Member"
            })
        });
    </script>
@stop
