@extends('adminlte::page')
@section('title', __('allowance::allowance.allowance-statement'))
@section('content_header')
    <x-core-content-header :title="__('allowance::allowance.allowance-statement')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <style>
        .swal2-container {
            z-index: 100000;
        }

        @media screen and (max-width: 425px) {
            #printButton {
                margin-top: 10px;
                margin-bottom: 5px;
            }

            #print-area div{
                overflow: scroll;
            }
        }

        @media screen and (max-width: 375px) {
            #printButton {
                margin-top: 10px;
                margin-bottom: 5px;
            }

            #print-area div{
                overflow: scroll;
            }

        }

        @media screen and (max-width: 320px) {
            #printButton {
                margin-top: 10px;
                margin-bottom: 5px;
            }

            #print-area div{
                overflow: scroll;
            }

        }
    </style>
@stop
@section('content')
    {{-- @dd($data->allowance) --}}
    <x-adminlte-card theme="primary" theme-mode="outline">
        <x-core-loader/>
        <div class="container">
            <div class="row py-2 justify-content-between">
                <div class="col-md-3">
                    <select class="select2 form-select form-select-sm" id="select2">
                        <option value="">---Select Month---</option>
                        @for ($a = 1; $a <= 12; $a++)
                            <option value="{{ date('F', mktime(0, 0, 0, $a, 1)) }}">{{ date('F', mktime(0, 0, 0, $a, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="button" id="printButton" class="btn btn-primary">
                        {{ __('allowance::allowance.statement-print') }}
                    </button>
                </div>
            </div>
            <div class="row" id="print-area">
                <div class="col-md-12 mb-4">
                    <table class="table" border="1" width="100%">
                        <tbody>
                            <tr>
                                <td class="bg-label-warning text-dark text-start" width="30%">
                                    {{ __('allowance::allowance.statement-name') }}</td>
                                <td>{{ $data->first_name . ' ' . $data->last_name }}</td>
                                <td class="bg-label-warning text-dark text-start">
                                    {{ __('allowance::allowance.statement-dob') }}</td>
                                <td>{{ $data->dob }}</td>
                                <td class="bg-label-warning text-dark text-start">
                                    {{ __('allowance::allowance.statement-code') }}</td>
                                <td>{{ $data->code }}</td>
                            </tr>
                            <tr>
                                <td class="bg-label-warning text-dark text-start">
                                    {{ __('allowance::allowance.statement-belong') }}</td>
                                <td>{{ $data->company?->name ?? 'N/A' }}</td>
                                <td class="bg-label-warning text-dark text-start">
                                    {{ __('allowance::allowance.statement-position') }}</td>
                                <td>{{ $data->roles[0]?->display_name ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 mt-4">
                    <table class="table table-bordered" border="1">
                        <thead>
                            <tr class="bg-label-warning">
                                <th>{{ __('allowance::allowance.statement-payment-item') }}</th>
                                <th>{{ __('allowance::allowance.statement-unit-won') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.statement-commission') }}</td>
                                <td id="commission">N/A</td>
                            </tr>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.statement-referral-bonus') }}</td>
                                <td id="referral_bonus">N/A</td>
                            </tr>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.statement-hr-allowance') }}
                                    {{-- <span>(Override)</span> --}}
                                </td>
                                <td id="headquarters_representative_allowance">
                                    N/A</td>
                            </tr>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.statement-organization-split-bonus') }}
                                </td>
                                <td id="organization_division_allowance">
                                    N/A</td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <span>{{ __('allowance::allowance.statement-initiative-bonus') }}</span>
                                </td>
                                <td id="initiative_bonus"></td>
                            </tr>
                            <tr>
                                <td class="text-start">
                                    <span>{{ __('allowance::allowance.statement-other-allowances') }}</span>
                                </td>
                                <td id="other_allowances">N/A</td>
                            </tr>
                            <tr class="bg-label-secondary">
                                <td>{{ __('allowance::allowance.statement-payment-item') }}</td>
                                <td id="payment_item"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 mt-4">
                    <table class="table table-bordered" border="1">
                        <thead>
                            <tr class="bg-label-warning" colspan="2">
                                <th>{{ __('allowance::allowance.statement-payment-item') }}</th>
                                <th>{{ __('allowance::allowance.statement-unit-won') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.statement-deduction-items') }}</td>
                                <td id="deduction_item"></td>
                            </tr>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.statement-resident-tax') }}</td>
                                <td id="resident_tax">N/A</td>
                            </tr>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.statement-year-end-settlement') }}</td>
                                <td id="year_end_settlement">N/A</td>
                            </tr>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.other-deductions-i') }}</td>
                                <td id="other_deductions_1">N/A</td>
                            </tr>
                            <tr>
                                <td class="text-start">{{ __('allowance::allowance.other-deductions-ii') }}</td>
                                <td id="other_deductions_2">N/A</td>
                            </tr>
                            {{-- payment_month,member_id,,,,,policy_allowance,,income_tax,,,,,,total_before_tax,deducted_amount_received --}}
                            <tr class="bg-label-secondary">
                                <td>{{ __('allowance::allowance.total-deduction') }}</td>
                                <td id="total_deduction">N/A</td>
                            </tr>
                            <tr class="bg-label-warning">
                                <td>{{ __('allowance::allowance.statement-actual-payout') }}</td>
                                <td id="actual_payout"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-adminlte-card>
@stop


@section('js')
    <script>
        $('.select2').select2({
            placeholder: "{{ __('allowance::allowance.statement-select-month') }}"
        })
        // $('#printButton').click(function() {
        //     let printable = document.getElementById('print-area').innerHTML
        //     let thispage = document.body.innerHTML = printable
        //     return
        //     var printWindow = window.open('', '_blank');
        //     printWindow.document.write('<html><head><title>Print</title></head><body>');
        //     printWindow.document.write(printable);
        //     printWindow.document.write('</body></html>');
        //     printWindow.document.close();
        //     printWindow.print();
        // });
        
        $('#select2').change(function() {
            var date = $(this).val();
            var url = "{{ route('admin.allowance-statement.get-allowance', ':date') }}";
            url = url.replace(':date', date);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                beforeSend : () =>{
                    $('.dataTables_processing').show();
                },
                success: function(response) {
                    $('.dataTables_processing').hide();
                    const allowance = response

                    $('#commission').html(allowance.commission ?? 'N/A');
                    $('#referral_bonus').html(allowance.referral_bonus ?? 'N/A');
                    $('#headquarters_representative_allowance').html(allowance
                        .headquarters_representative_allowance ?? 'N/A');
                    $('#organization_division_allowance').html(allowance
                        .organization_division_allowance ?? 'N/A');
                    $('#other_allowances').html(allowance.other_allowances ?? 'N/A');
                    $('#resident_tax').html(allowance.resident_tax ?? 'N/A');
                    $('#year_end_settlement').html(allowance.year_end_settlement ?? 'N/A');
                    $('#other_deductions_1').html(allowance.other_deductions_1 ?? 'N/A');
                    $('#other_deductions_2').html(allowance.other_deductions_2 ?? 'N/A');
                    $('#total_deduction').html(allowance.total_deduction ?? 'N/A');
                    $('#initiative_bonus').html(allowance.referral_bonus ?? 'N/A');
                    $('#payment_item').html(allowance.payment_month ?? 'N/A');
                    $('#deduction_item').html(allowance.other_deductions_1 ?? 'N/A');
                    $('#actual_payout').html(allowance.total_deduction ?? 'N/A');

                },
                error: function(xhr, status, error) {
                    $('.dataTables_processing').hide();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: error
                    });
                    $('#commission').html('');
                    $('#referral_bonus').html('');
                    $('#headquarters_representative_allowance').html('');
                    $('#organization_division_allowance').html('');
                    $('#other_allowances').html('');
                    $('#resident_tax').html('');
                    $('#year_end_settlement').html('');
                    $('#other_deductions_1').html('');
                    $('#other_deductions_2').html('');
                    $('#total_deduction').html('');
                    $('#initiative_bonus').html('');
                    $('#payment_item').html('');
                    $('#deduction_item').html('');
                    $('#actual_payout').html('');
                }
            });
        });
    </script>
@stop
