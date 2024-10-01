<?php

namespace Modules\Core\Services;

class KakaoSMSService
{

    public function __construct()
    {

    }

    private function Call($callUrl, $method, $headers = array(), $data = array(), $returnType = "jsonObject")
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $callUrl);
            if ($method == "POST") {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            } else {
                curl_setopt($ch, CURLOPT_POST, false);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HTTP200ALIASES, array(400));
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($returnType == "jsonObject") return json_decode($response);
            else return $response;
        } catch (\Exception $e) {
            return $e;
        }
    }

    private function getToken($REST_API_KEY, $REDIRECT_URI, $CLIENT_SECRET)
    {
        // Doc URL : https://developers.kakao.com/docs/latest/en/kakaologin/rest-api#request-token

        $code = '';
        $callUrl = "https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id=" . $REST_API_KEY . "&redirect_uri=" . $REDIRECT_URI . "&code=" . $code . "&client_secret=" . $CLIENT_SECRET;
        $res = $this->Call($callUrl, "POST");
        if ($res->error_code == "KOE320") die("[KOE320] code 받은 후, 새로고침하면 code 재사용 불가 에러 : 다시 로그인 시도 할 것");
    }

    private function getData($message)
    {

        // DOC URL : https://developers.kakao.com/docs/latest/en/message/rest-api#default-template-msg-me-sample

        return 'template_object={
        "object_type": "text",
        "text": "' . $message . '",
        "link": {
            "web_url": "https://developers.kakao.com",
            "mobile_web_url": "https://developers.kakao.com"
        },
        "button_title": "Check it out"
        }';

    }

    public function send($message)
    {
        $redirect_url = '';
        $access_token = $this->getToken(env('KAKAO_REST_API_KEY'), $redirect_url, env('KAKAO_CLIENT_SECRET'));
        $callUrl = "https://kapi.kakao.com/v2/api/talk/memo/default/send";
        $headers = array('Content-type:application/x-www-form-urlencoded;charset=utf-8');
        $headers[] = "Authorization: Bearer " . $access_token;
        return $this->Call($callUrl, "POST", $headers, $this->getData($message));

    }

}
