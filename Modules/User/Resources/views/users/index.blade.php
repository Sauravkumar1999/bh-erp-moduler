@extends('adminlte::page')

@section('title', __('user::user.user'))

@section('content_header')

    <x-core-content-header :title="@lang('user::user.membership-management')" :breadcrumbs="$breadcrumbs" />
    <style>
        .card {
            --bs-card-spacer-x: 0 !important;
        }

        .user-tabel-heading {
            color: #2B2B2B;
            font-size: 18px;
            font-family: Pretendard;
            font-weight: 500;
            line-height: 24px;
        }

        #imageModal .modal-dialog {
            max-width: 400px;
            top: 50%;
            transform: translateY(-50%);
        }

        #userMemberStatus>option[value="0"] {
            color: orange;
            border-radius: 5px;
        }

        #userMemberStatus>option[value="1"] {
            color: green;
            border-radius: 5px;
        }

        .add_button {
            display: flex;
            gap: 10px;
            margin: 5px 0px;
        }

        .add_button button {
            width: 80px;
        }

        .DTE_Field_Name_gender .DTE_Field_InputControl div {
            display: flex !important;
        }


        .user {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        input[type=search]::-webkit-search-cancel-button{
            cursor:pointer
        }
        @media (max-width: 568px) {
            .DTE_Field_Name_dob div {
                padding-right: 0px !important;
            }

            #user-table_filter {
                margin-right: 0rem !important;
                margin-top: 0rem !important;
            }

            .dataTables_length {
                margin-top: 0rem !important;
            }

            div.dataTables_wrapper div.dataTables_length select {
                margin-left: 0px !important;
                margin-right: 0 !important;
            }

            div.dataTables_wrapper div.dataTables_length select {
                width: 70px !important;
            }

            .user {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            hr {
                margin: 10px !important;
            }
        }

        .DTE_Field_Name_gender div {
            /* width: 80% !important; */
        }

        .DTE_Field_Name_gender div label {
            margin-left: 5px !important;
        }

        .dt-buttons {
            display: flex;
            gap: 10px;
            margin-left: 10px;
        }

        #user-table_filter {
            margin-top: 1rem;
            margin-right: 1rem;
        }

        .password-field {
            width: 60%;
            display: inline-block;
            margin-right: 25px;
        }

        .dt-buttons {
            display: flex;
            justify-content: end;
        }

        div.dataTables_wrapper div.dataTables_length select {
            margin-left: 0;
            margin-right: 0;
        }

        #user-table_wrapper .dt-buttons button.add_new_class {
            white-space: nowrap;
        }

        div.DTE div.editor_upload.noClear div.clearValue button {
            display: none !important;
        }


        div.DTE div.editor_upload.multi div.clearValue {
            display: none !important;
        }

        #productSettingForm thead {
            background: #EC661A12;
            font-family: Pretendard;
        }

        .table_div {
            margin-bottom: 20px;
        }

        .table-scroll {
            overflow-x: auto;
        }

        .titles {
            word-wrap: break-word;
            text-wrap: wrap;
            min-width: 50% !important;
            background: #EC661A12 !important;
        }

        /* Handle */
        .table-scroll::-webkit-scrollbar {
            width: 2px !important;
            height: 10px !important;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: #ec661a;
            border-radius: 5px;
        }

        .table-scroll::-webkit-scrollbar-track {
            background-color: #dbdade;
        }

        .table-scroll::-webkit-scrollbar-corner {
            background-color: #dbdade;
        }

        .table-scroll::-webkit-scrollbar-thumb:hover {
            background: #f1f1f1;
        }

        .company-table thead tr td {
            overflow-wrap: anywhere;
        }

        .DTE_Header .DTE_Header_Content {
            width: 100%;
        }

        .DTE_Header .DTE_Header_Content {
            display: grid;
            place-items: center;
            padding-top: 20px;
        }

        .addRelative {
            position: absolute !important;
            top: 0% !important;
            margin-bottom: 10px !important;
        }
        .DTE_Field_Name_submitted_date .DTE_Field_InputControl {
            display: flex !important;
            gap: 10px;
        }

        @media screen and (max-width: 767px) {
            .form-control:not(.DTE_Field_InputControl .form-check-input, .DTE_Field_InputControl .form-control) {
                width: auto;
            }
            .addRelative {
                position: relative !important;
            }
            #user-table_filter {
                margin-right: 0rem !important;
                margin-top: 0rem !important;
            }
            div.dt-buttons {
                margin-bottom: 10px;
                margin-top: 10px;
            }

            div#user-table_filter label,
            div#user-table_filter label input {
                width: 100% !important;
            }

            #user-table_length {
                display: none;
            }

            .password-field {
                width: 100%;
                margin-right: 0px;
            }
        }

        #copy_pwd {
            background-color: #ec661a !important;  /* Reset any background color changes */
        }

    </style>

@stop

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        <div class="select-container mb-3 px-4">
            <div class="row g-2">
                <div class="col-md-12">
                    <h3 class="user-tabel-heading">검색 필터</h3>
                </div>
                <div class="col-6 col-md-3">
                    <select id="statusDropdown" class="form-select">
                        <option value="">@lang('core::core.select-all')</option>
                        <option value="waiting">@lang('user::user.waiting')</option>
                        <option value="approval">@lang('user::user.approval')</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <select id="divisionDropdown" class="form-select ">
                        <option value="">@lang('core::core.select-all')</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->display_name }}">{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <div class="d-flex justify-content-between form-group form-control"
                        style="border-radius: 5px; cursor: pointer; padding: 6px 15px 6px;">
                        {{-- <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp; --}}
                        <input type="text" name="daterange" id="date_range"
                            placeholder="{{ trans('user::user.confirmed-date') }}" class="pull-left date_picker"
                            style=" width: 100%; border: none !important;
                        outline: none; cursor: pointer; padding: 0px 0px;">
                        <a class="btn-link mx-2 px-1 py-0" id="clear_datepicker" data-allow-clear="true"><span
                                style="font-weight:500;float: right;
                        font-size: 1.05rem;">x</span></a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <select id="membershipDropdown" class="form-select ">
                        <option value="">@lang('core::core.select-all')</option>
                        <option value="waiting">@lang('user::royal.pending-approval')</option>
                        <option value="approval">@lang('user::royal.approved')</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="line-3">
            <hr>
        </div>
        {!! $dataTable->table() !!}

    </x-adminlte-card>
    <!-- Include the Livewire component -->
    <livewire:user::auth.edit-permission />

    <!-------------------------------------Show Image modal------------------------------------------------------>
    <div class="modal fade" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="Image" class="w-100 h-100">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------End Show Image modal-------------------------------------------------->
    <!-------------------------------------start Show Product setting-------------------------------------------------->
    <div class="modal fade" id="product-setting" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-sm" role="document">
            {{-- modal-dialog-scrollable modal-dialog-centered modal-xl --}}
            <div class="modal-content ">
                {{-- company-content --}}
                <div class="modal-header">
                    <h5 class="modal-title custom_modal-title">배너</h5>
                    {{-- custom_modal-title --}}
                    <button type="button" class="close-modal-button" data-dismiss="modal" onclick="closeModal()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table_div">
                        <table border="1" class="table table-responsive company-table border-1">
                            <thead>
                                <tr>
                                    <td scope="col" class="titles col-6">{{ trans('user::role.name') }}</td>
                                    <td scope="col" class="col-6" id="products-name"></td>
                                </tr>
                                <tr>
                                    <td scope="col" class="titles col-6">{{ trans('user::user.code') }}</td>
                                    <td scope="col" class="col-6" id="products-code">16,000</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="titles col-6">{{ trans('user::user.email') }}</td>
                                    <td scope="col" class="col-6" id="products-email">16,000</td>
                                </tr>
                                <tr>
                                    <td scope="col" class="titles col-6">{{ trans('user::user.contact') }}</td>
                                    <td scope="col" class="col-6" id="products-contact">16,000</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="row">
                        <form class="col-md-12" id="productSettingForm" method="POST">
                            @csrf
                            <div class="table-scroll">
                                <table class="table table-responsive border-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ trans('product::product.product-name') }}</th>
                                            <th scope="col">Url</th>
                                            <th scope="col">{{ trans('user::manage-user.item-exposure') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="product-data">
                                    </tbody>
                                </table>
                                <input type="hidden" name="user_id" id="user_id">
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-center gap-2 w-100">
                        <button type="submit" form="productSettingForm" class="btn btn-primary">저장하기</button>
                        <button class="btn btn-primary" onclick="closeModal()">확인 </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------End Show Product setting-------------------------------------------------->
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/dt-editor/css/editor.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">


    <link rel="stylesheet" href="{{ asset('/vendor/vuexy/css/flatpickr.css') }}">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> -->
@stop


<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/dataTables.editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/dt-editor/js/editor.bootstrap5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/input-mask/inputmask.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/datatables/buttons.print.min.js') }}"></script>




    <!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->
    <script type="text/javascript" src="{{ asset('/vendor/vuexy/js/flatpickr.js') }}"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $(window).resize(function() {
            if ($(window).width() < 768) {
                $('#user-table_length').addClass("d-block addRelative");
            } else {
                $('#user-table_length').removeClass("d-block addRelative");
            }
        });
    </script>

    <script>
        let tableId = "{!! $dataTable->getTableAttribute('id') !!}";
        let editor = window.LaravelDataTables[tableId + "-editor"]
        let grid = window.LaravelDataTables[tableId];

        $(document).ready(function() {
            const date_picker = document.querySelector('.date_picker');
            let options = {
                mode: "range",
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        var splitData = dateStr.split(" ");
                        var startDate = splitData[0];
                        var endDate = splitData[2];
                        applyFilters(startDate, endDate);
                    }
                }
            };
            date_picker.flatpickr(options);

            $('#clear_datepicker').on('click', function() {
                $(this).prev().flatpickr(options).clear();
                grid.draw();
            });

            // Trigger manual initialization of tooltips
            var tooltipTriggerList = [].slice.call($('[data-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Event listener for clicking on the button
            let copyPwdBtn = $('#copy_pwd');
            $(document).on('click', '#copy_pwd', function() {

                var copyText = $(this).attr('data-password');
                navigator.clipboard.writeText(copyText);

                // Determine the title based on the document's language
                var titleText = document.documentElement.lang === 'ko' ? '복사됨' : 'Copied';


                // Dispose of the existing tooltip
                $('#copy_pwd').tooltip('dispose').tooltip({
                    title: titleText,
                    placement: 'top',
                    container: '#copy_pwd',
                    trigger: 'manual'
                });

                // Show the tooltip
                $('#copy_pwd').tooltip('show');

                setTimeout(() => {
                    $('#copy_pwd').tooltip('hide');

                }, 1000);

            });

             // Add event listener to close the tooltip when clicking outside
            $(document).on('click', function(event) {
                if ($(event.target).closest('#copy_pwd').length === 0) {
                    $('#copy_pwd').tooltip('hide');
                }
            });

            $(document).on('click', '#generate_pwd', function() {
                $('#password').val('');
                // Determine the title based on the document's language
                var titleText = document.documentElement.lang === 'ko' ? '복사됨' : 'Copy';

                let password = makeRandomPass(10);
                $('#password').val(password);
                $('#copy_pwd').attr('data-password', password);
                $('#copy_pwd').attr('data-toggle', 'tooltip');
                $('#copy_pwd').attr('data-placement', 'top');
                $('#copy_pwd').attr('title', titleText);

                // Dispose the existing tooltip and reinitialize with the custom class
                // $('#copy_pwd').tooltip('dispose').tooltip({
                //     placement: 'top',
                //     title: titleText,
                //     container: '#copy_pwd',
                // });
            })

            // membership reject
            $(document).on('click', '.membership-reject-btn', function() {
                $('#DTE_Field_submitted_date').val('')
            })
            //filter data
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                locale: {
                    format: '{{ strtoupper(setting('date_format_js')) }}',
                    separator: " ~ "
                }
            }, cb);
            cb(start, end);
            $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                let startDate = picker.startDate.format('YYYY-MM-DD');
                let endDate = picker.endDate.format('YYYY-MM-DD');
                applyFilters(startDate, endDate);
            });

            $('#statusDropdown, #divisionDropdown, #membershipDropdown').on('change', function() {
                applyFilters();
            });


            function applyFilters(startDate, endDate) {
                let status = $('#statusDropdown').val();
                let division = $('#divisionDropdown').val();
                let membership = $('#membershipDropdown').val();
                grid.columns().search('').draw();

                if (status) {
                    status = mapStatusLabelToValue(status);
                    grid.columns(0).search(status);
                }

                if (division) {
                    grid.columns(4).search(division);
                }
                if (startDate && endDate) {
                    grid.columns(11).search(function(value, index, row) {
                        var date = new Date(value);
                        var startDateObj = new Date(startDate);
                        var endDateObj = new Date(endDate);
                        return date >= startDateObj && date <= endDateObj;
                    });
                }
                if (membership) {

                    grid.columns(17).search('^(?!$)');
                }

                grid.draw();
            }

            function mapStatusLabelToValue(label) {
                switch (label) {
                    case 'waiting':
                        return 0;
                    case 'approval':
                        return 1;
                    default:
                        return label;
                }
            }

            // Edit record
            grid.on('click', 'button.editor-edit', function(e) {
                e.preventDefault();
                editor.edit(e.target.closest('tr'), {
                    title: '<?php echo trans('user::user.edit-member-information'); ?>',
                    buttons: [{
                            text: 'Close',
                            action: function() {
                                editor.close();
                            }
                        },
                        {
                            text: 'Update',
                            action: function() {
                                var telephoneField = editor.field('telephone_1');
                                var telephoneInput = telephoneField.input();

                                // Remove input mask
                                telephoneInput.inputmask('remove');

                                var telephoneValue = telephoneField.val();
                                var telephoneWithoutNonNumeric = telephoneValue.replace(/\D/g, '');
                                editor.on('preSubmit', function (e, data, action) {
                                    if (action !== 'remove') {
                                        Object.keys(data.data).forEach(function(key) {
                                            // Access the 'telephone_1' property of each object and modify it
                                            data.data[key].telephone_1 = telephoneWithoutNonNumeric;
                                        });
                                    }
                                });

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

            //fetch media using axios
            window.openImageDataModal = function(fileUrl, imageType) {
                let fileType = (imageType === 'idCard') ? 'idCard' : 'bankbook';
                $('#imageModal .modal-title').text(imageType == 'idCard' ? 'ID Card' : 'Bankbook');
                $('#imageModal .modal-body img').attr('src', fileUrl);
                $('#imageModal').modal('show');
            }

        });

        // livewire modal loaded
        window.addEventListener('modal-loaded', event => {
            $("#" + tableId + "_processing").hide();
        });

        // livewire modal closed
        window.addEventListener('modal-closed', event => {
            $("#" + tableId + "_processing").hide();
        });
    </script>

    <script>
        //Assign permissions
        function selectPermissions(element, name) {

            let checkboxes = $(`#chk_list_${name}`).find(':checkbox');

            if ($(element).prop('checked')) {
                $(`#chk_list_${name} :checkbox`).prop('checked', true);

                checkboxes.each(function() {
                    window.livewire.emit('checkboxChecked', $(this).attr('id').split('_')[1]);
                    console.log('checked');
                });
            } else {
                $(`#chk_list_${name} :checkbox`).prop('checked', false);
                // $(`#chk_list_${name} :checkbox`).prop('checked', true);

                checkboxes.each(function() {
                    window.livewire.emit('checkboxUnChecked', $(this).attr('id').split('_')[1]);
                    console.log('unchecked');
                });

            }

        }

        function selectOnePermission (ele, name) {
            checkboxes = $(`#chk_list_${name}`).find(':checkbox');

            let allChecked = true;

            checkboxes.each(function() {
                if (!$(this).prop('checked')) {
                    allChecked = false;
                    return false; // Exit the loop early since we found an unchecked checkbox
                }
            });

            if (allChecked) {
                window.livewire.emit('checkContainer', name);

            } else {
                window.livewire.emit('uncheckContainer', name);
            }

        }

        function generate_password_html() {
            $('.add_button').remove();
            $('.DTE_Field_Name_password .DTE_Field_InputControl').after(function() {
                let html = '{!! sanitize_output(view('user::users.templates._password-generator')->render()) !!}';
                $(this).append(html);
            })
        }
        function generate_reject_button() {
            $('.DTE_Field_Name_submitted_date .DTE_Field_InputControl button').remove();
            $('.DTE_Field_Name_submitted_date .DTE_Field_InputControl').after(function() {
                let html = '<button class="btn btn-primary btn-sm p-2 membership-reject-btn text-nowrap">{{trans("user::user.royal-member-reject")}}</button>';
                $(this).append(html);
            })
        }

        function makeRandomPass(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            const numbers = '0123456789';
            const specials = '!@#$%^&*()-_';
            result += letters.charAt(Math.floor(Math.random() * letters.length));
            result += numbers.charAt(Math.floor(Math.random() * numbers.length));
            result += specials.charAt(Math.floor(Math.random() * specials.length));
            for (var i = 0; i < length - 3; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }

            // Shuffle the generated password
            result = result.split('').sort(function () { return 0.5 - Math.random() }).join('');

            return result;
        }


        function closeModal() {
            $('#product-setting').modal('hide');
        }

        function productSetting(id) {
            let button = event.target
            let url = "{{ route('admin.users.product', ':id') }}";
            url = url.replace(':id', id);
            button.innerHTML = `<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Loading...`;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    button.innerHTML = "{{ trans('product::product.look') }}";
                    if (response.status === 'success') {
                        let tbody = $('#product-setting .product-data');
                        tbody.html('')
                        $("#user_id").val(response?.user.id);
                        $('#products-name').text(response?.user?.first_name + ' ' + (response?.user
                            ?.last_name ?? ''))
                        $('#products-code').text(response?.user?.code)
                        $('#products-email').text(response?.user?.email)
                        $('#products-contact').text(response?.user?.contacts[0]?.telephone_1)
                        $.each(response.data, function(k, v) {
                            let tr = `<tr><td><span>${v.product_name}<span><input type="hidden" class="product_input" name="products[]" value="${v.id}"> </td>
                            <td>
                                <input type="text" data-url="url" value="${v.p_url?? 'N/A'}" class="form-control" name="url_${v.id}" />
                                <div class="errors invalid-feedback" id="url_${v.id}_error">Invalid URL !</div>
                            </td>
                            <td>
                                <div class="d-flex gap-3 justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input prod_expo" type="radio" name="prod_expose_${v.id}"
                                        id="prod_on_${v.id}" data-id="${v.id}" value="on" ${(!v.hasOwnProperty('p_status') || v.p_status) ? 'checked' : ''}>
                                    <label class="form-check-label" for="prod_on_${v.id}"> on </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input prod_expo" type="radio" name="prod_expose_${v.id}"
                                        id="prod_off_${v.id}" data-id="${v.id}" value="off" ${v.hasOwnProperty('p_status') && !v.p_status ? 'checked' : ''}>
                                    <label class="form-check-label" for="prod_off_${v.id}"> off </label>
                                </div>
                            </div>
                            </td>
                            </tr>`;
                            tbody.append(tr);
                        });
                    } else {
                        alert(response.message)
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            $('#product-setting').modal('show');
        }

        $('#productSettingForm').on('submit', function(event) {
            event.preventDefault();
            let validUrl = true;
            $(this).find('tr td input[data-url="url"]').each(function() {
                let inputValue = $(this).val();
                if (inputValue.trim() !== '' && !isValidUrl(inputValue)) {
                    validUrl = false;
                    $(this).addClass('is-invalid');
                    $(this).closest('.invalid-feedback').addClass('d-block')
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).closest('.invalid-feedback').removeClass('d-block')
                }
            });
            if (!validUrl) {
                $('tr td input[data-url="url"].is-invalid').on('keyup', function(event) {
                    let inputValue = $(this).val();
                    if (!isValidUrl(inputValue)) {
                        $(this).addClass('is-invalid');
                        $(this).closest('.invalid-feedback').addClass('d-block')
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).closest('.invalid-feedback').removeClass('d-block')
                    }
                });
                return;
            }

            // If URL validation passes, proceed with form submission
            let formData = $(this).serialize();
            $(event.target).find(':submit').html(
                '<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Loading...');
            $.ajax({
                url: "{{ route('admin.users-product-settings') }}",
                type: 'PUT',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    $('#product-setting').modal('hide');
                    Swal.fire({
                        title: "Successfully updated!",
                        icon: "success"
                    });
                },
                error: function(error) {
                    Swal.fire({
                        title: "Couldn't update",
                        icon: "error"
                    });
                }
            });
        });

        function isValidUrl(url) {
            let urlPattern = new RegExp(
                "^" + "(?:(?:https?|ftp)://)" + "(?:\\S+(?::\\S*)?@)?" + "(?:" +
                "(?!(?:10|127)(?:\\.\\d{1,3}){3})" +
                "(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})" +
                "(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})" +
                "(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])" +
                "(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}" +
                "(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))" + "|" +
                "(?:(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)" +
                "(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-*)*[a-z\\u00a1-\\uffff0-9]+)*" +
                "(?:\\.(?:[a-z\\u00a1-\\uffff]{2,}))" + "\\.?" + ")" + "(?::\\d{2,5})?" + "(?:[/?#]\\S*)?" + "$", "i"
            );
            return urlPattern.test(url);
        }

        function loading() {
            $("#" + tableId + "_processing").css('z-index', '10000');
            $("#" + tableId + "_processing").show();
        }
    </script>
    <script type="text/javascript" src="{{ asset('/vendor/datepicker/daterange-picker.js') }}"></script>

@stop
