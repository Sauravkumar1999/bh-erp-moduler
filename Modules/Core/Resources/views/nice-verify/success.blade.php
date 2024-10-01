@if(isset($result["status"]) && $result["status"] == "success")

    @php
      $decodeData = $result["data"];
      $user_name = $decodeData["NAME"];
      $birth_date = $decodeData["BIRTHDATE"];
      $mobile_no = $decodeData["MOBILE_NO"];
      $gender = $decodeData["GENDER"];
    @endphp

    <script>
 self.close();
        if (typeof opener.parent !== 'undefined' && opener.parent) {
            opener.parent.nicePhoneVerifyCallback(
                { "name": "{{ $user_name }}", "birthdate": "{{ $birth_date }}", "mobile_no": "{{ $mobile_no }}", "gender": "{{ $gender }}" });
        } else {
            alert('오류가 발생했습니다! 새로고침 후 다시 시도해주세요.');
        }

    </script>

@else

    <script>
 self.close();
        alert('본인인증 복호화에 실패하였습니다. 관리자에게 문의해주세요.');

    </script>

@endif
