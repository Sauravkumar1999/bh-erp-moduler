<?php

namespace Modules\Core\Services;

use Jenssegers\Agent\Facades\Agent;

class NiceVerifyService
{

    private string $siteCode;
    private string $sitePassword;
    private string $cpClient;
    private string $returnURL;
    private string $errorURL;
    private string $authType;
    private string $popGubun;

    public function __construct()
    {
        $this->siteCode = env('NICE_SITE_CODE');
        $this->sitePassword = env('NICE_SITE_PASSWORD');
        $this->cpClient = $this->getCPClient();
        $this->authType = "M";
        $this->popGubun = "N";
    }

    public function initNiceForm()
    {
        if (session()->has('NICE_PHONE_ENCODE_DATA')) {
            session()->forget('NICE_PHONE_ENCODE_DATA');
        }

        $result = $this->getPhoneEncodeData();

        return sanitize_output(view('core::nice-verify.nice-form', compact('result'))->render());
    }

    private function getCPClient()
    {
        if (PHP_OS_FAMILY === "Windows") {
            return module_path('Core', 'Resources/libs/nice-phone-verify/CPClient_x64.exe');
        } elseif (PHP_OS_FAMILY === "Linux") {
            return module_path('Core', 'Resources/libs/nice-phone-verify/CPClient_linux_x64');
        } else {
            return module_path('Core', 'Resources/libs/nice-phone-verify/CPClient_mac');
        }
    }

    public function setCPClient(string $path)
    {
        $this->cpClient = $path;
    }

    public function setReturnURL(string $returnURL)
    {
        $this->returnURL = $returnURL;
    }

    public function setErrorURL(string $errorURL)
    {
        $this->errorURL = $errorURL;
    }

    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }

    public function getPhoneDecodeData($encodeData)
    {
        $plainData = iconv('EUC-KR', 'UTF-8', `$this->cpClient DEC $this->siteCode $this->sitePassword $encodeData`);

        if ($plainData == -1) {
            return array(
                'status' => 'failed',
                'msg'    => '암/복호화 시스템 오류'
            );
        } elseif ($plainData == -4) {
            return array(
                'status' => 'failed',
                'msg'    => '복호화 처리 오류'
            );
        } elseif ($plainData == -5) {
            return array(
                'status' => 'failed',
                'msg'    => 'HASH값 불일치 - 복호화 데이터는 리턴됨'
            );
        } elseif ($plainData == -6) {
            return array(
                'status' => 'failed',
                'msg'    => '복호화 데이터 오류'
            );
        } elseif ($plainData == -9) {
            return array(
                'status' => 'failed',
                'msg'    => '입력값 오류'
            );
        } elseif ($plainData == -12) {
            return array(
                'status' => 'failed',
                'msg'    => '사이트 비밀번호 오류'
            );
        } else {
            // 정상 복호화 진행
            $a = explode(':', $plainData);

            $na = array();

            foreach ($a as $k => $v) {
                if ($k > 0 && $k % 2 == 1) {
                    preg_match('/(\d{1,3})$/', $v, $cl);

                    $cl = $cl[0];
                    $rv = mb_strcut($v, 0, mb_strpos($v, $cl));

                    if ($rv == 'NAME') $cl = ($cl / 2) * 3;
                    if ($rv == 'UTF8_NAME') {
                        $na[$rv] = urldecode(mb_strcut($a[$k + 1], 0, $cl));
                    } else {
                        $na[$rv] = mb_strcut($a[$k + 1], 0, $cl);
                    }
                }
            }
        }

        if ($na && $na['NAME'] && $na['BIRTHDATE'] && $na['MOBILE_NO'] && $na['DI']) {
            return array(
                'status' => 'success',
                'data'   => $na
            );
        } else {
            return array(
                'status' => 'failed',
            );
        }
    }

    private function getPhoneEncodeData()
    {
        $reqSeq = $this->siteCode . '_' . now()->getTimestamp();
        $customize = Agent::isMobile() ? "Mobile" : Agent::isDesktop();
        $gender = "";

        $encVar_ =
            '7:REQ_SEQ' . strlen($reqSeq) . ':' . $reqSeq .
            '8:SITECODE' . strlen($this->siteCode) . ':' . $this->siteCode .
            '9:AUTH_TYPE' . strlen($this->authType) . ':' . $this->authType .
            '7:RTN_URL' . strlen($this->returnURL) . ':' . $this->returnURL .
            '7:ERR_URL' . strlen($this->errorURL) . ':' . $this->errorURL .
            '11:POPUP_GUBUN' . strlen($this->popGubun) . ':' . $this->popGubun .
            '9:CUSTOMIZE' . strlen($customize) . ':' . $customize .
            '6:GENDER' . strlen($gender) . ':' . $gender;

        $encVar = `$this->cpClient ENC $this->siteCode $this->sitePassword $encVar_`;

        if ($encVar == -1) {
            return array(
                'status' => 'failed',
                'msg'    => '암/복호화 시스템 오류'
            );
        } elseif ($encVar == -4) {
            return array(
                'status' => 'failed',
                'msg'    => '복호화 처리 오류'
            );
        } elseif ($encVar == -5) {
            return array(
                'status' => 'failed',
                'msg'    => 'HASH값 불일치 - 복호화 데이터는 리턴됨'
            );
        } elseif ($encVar == -6) {
            return array(
                'status' => 'failed',
                'msg'    => '복호화 데이터 오류'
            );
        } elseif ($encVar == -9) {
            return array(
                'status' => 'failed',
                'msg'    => '입력값 오류'
            );
        } elseif ($encVar == -12) {
            return array(
                'status' => 'failed',
                'msg'    => '사이트 비밀번호 오류'
            );
        } else {
            // 정상진행
            return array(
                'status' => 'success',
                'data'   => $encVar
            );
        }
    }

    public function formatDOB(string $dob)
    {
        return date("Y-m-d", strtotime($dob));
    }
}
