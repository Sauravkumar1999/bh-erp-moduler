@php
    $currentYear = date('Y');
@endphp
<div class="form-group col-md-12">
    <label for="appointment_schedule">{{ isset($label) ? $label : '' }} <img src="{{ themes('images/required.svg') }}" alt=""></label>
    <div class="row" id="appointment_schedule">
        <div class="col-md-3 col-4">
            <select name="available_call_year" id="available_call_year"
                    class="form-control form-select date-select" required>
                <option value="{{ $currentYear }}" selected>{{ $currentYear }}</option>
                <option value="{{ date('Y', strtotime('+1 year')) }}">
                    {{ date('Y', strtotime('+1 year')) }}</option>
            </select>
            @error('available_call_year')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3 col-4">
            <select name="available_call_month" id="available_call_month"
                    class="form-control form-select date-select" required>
                @for ($month = 1; $month <= 12; $month++)
                    <option value="{{ sprintf('%02d', $month) }}"
                        {{  ltrim($month, '0') == date('m') ? 'selected' : '' }}
                        {{ ltrim($month, '0') < date('m') ? 'disabled' : '' }}>
                        {{ sprintf('%02d', $month) }}
                    </option>
                @endfor
            </select>
            @error('available_call_month')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3 col-4">
            <select name="available_call_day" id="available_call_day"
                    class="form-control form-select date-select" required>
                @for ($day = 1; $day <= 31; $day++)
                    <option value="{{ sprintf('%02d', $day) }}"
                        {{ ltrim($day, '0') == date('d') ? 'selected' : '' }}
                        {{ ltrim($day, '0') < date('d') ? 'disabled' : '' }}>
                        {{ sprintf('%02d', $day) }}
                    </option>
                @endfor
            </select>

            @error('available_call_day')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3 col-12 last-select">
            <select name="available_call_hour" id="available_call_hour"
                    class="form-control form-select" required>
                {{-- <option value="">시간선택</option> --}}
                @php
                    $currentTime = strtotime('+'.$interval.' hours');
                    $maxTime = strtotime($max_time);
                    $startTime = strtotime($min_time);
                @endphp
            </select>

            @error('available_call_hour')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div style="margin-top: 8px">
    </div>
</div>

@push('scripts')

    <script type="text/javascript">

        const yearSelect = document.getElementById('available_call_year');
        const monthSelect = document.getElementById('available_call_month');
        const daySelect = document.getElementById('available_call_day');
        const hourSelect = document.getElementById('available_call_hour');

        $(document).ready(function() {

            $('.date-select').on('change', function() {
                var year = $('#available_call_year').val();
                var month = $('#available_call_month').val();
                var day = $('#available_call_day').val();
                renderTime(year, month, day);
            });

            $('.date-select').trigger('change');

        });

    </script>

    <script>
        function renderTime(year, month, day) {
            var selectedDate = year + '-' + month.padStart(2, '0') + '-' + day.padStart(2, '0');

            var today = new Date().toISOString().split('T')[0];
            var timeDropdown = $('#available_call_hour');
            timeDropdown.empty();

            if (selectedDate === today) {
                timeDropdown.append($('<option>', {
                    value: null,
                    text: '시간선택'
                }));

                appendOptions(timeDropdown);
                disableMonthAndDay();
                $('#available_call_hour').removeAttr('disabled');
                $('#available_call_hour option').each(function() {
                    var formTime = convertTo24Hour($(this).val());
                    if (formTime !== null) {
                        if (formTime < '{{ (intval(date('H')) + 3 )%24 }}') {
                            $(this).prop('disabled', true);
                        }
                    }
                });
            } else {
                // if the year is the same but not today
                if (year != '{{ date('Y') }}') {
                    $('#available_call_month').find('option').prop('disabled', false);
                    $('#available_call_day').find('option').prop('disabled', false);
                } else {
                    disableMonthAndDay();
                }
                appendOptions(timeDropdown);
            }
        }

        function convertTo24Hour(input) {
            if (input !== "시간선택") {
                var timeSplit = input.split(':');
                var hours = parseInt(timeSplit[0]);
                var minutes = parseInt(timeSplit[1].split(' ')[0]);
                var meridian = timeSplit[1].split(' ')[1];

                // Adjust hours based on meridian
                if (meridian === "PM" && hours < 12) {
                    hours += 12;
                } else if (meridian === "AM" && hours === 12) {
                    hours = 0;
                }

                // Return time in 24-hour hours
                return hours;
            }

            return null;
        }

        function disableMonthAndDay() {
            $('#available_call_month option').each(function() {
                if ($(this).val() < '{{ date('m') }}') {
                    $(this).prop('disabled', true);
                }
            });
            $('#available_call_day option').each(function() {
                if ($(this).val() < '{{ date('d') }}') {
                    $(this).prop('disabled', true);
                }
            });
        }

        function appendOptions(timeDropdown) {
            for (var time = 540; time <= 1080; time += 60) {
                var hours = Math.floor(time / 60);
                var minutes = time % 60;
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // Handle midnight (0 hours)
                var formattedTime = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' :
                    '') + minutes + ' ' + ampm;
                timeDropdown.append($('<option>', {
                    value: formattedTime,
                    text: formattedTime
                }));
            }
        }

    </script>

@endpush
