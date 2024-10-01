@if(isset($result['status']) && $result['status'] == 'success')

    <form name="nice_verify_form" method="POST" style="display: none !important;">
        <input type="hidden" name="m" value="checkplusSerivce">
        <input type="hidden" name="EncodeData" value="{{ $result['data'] }}">
    </form>

    <script>
        /**
         * 나이스 인증창 띄우기
         */
        let nice_window;
        let nice_form;
        function nicePhoneVerify() {
            nice_window = window.open("","NiceModule","width=500,height=800,scrollbars=1");
            nice_form = document.nice_verify_form;

            nice_form.action = "https://nice.checkplus.co.kr/CheckPlusSafeModel/checkplus.cb";
            nice_form.target = "NiceModule";
            nice_form.method = "POST";
            nice_form.submit();
        }
    </script>

@else
    <script>
        jQuery(window).ready(function() {
            // console.log("나이스 인증평가 초기화 오류");
        })
    </script>
@endif
