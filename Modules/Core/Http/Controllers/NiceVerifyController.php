<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Services\NiceVerifyService;

class NiceVerifyController extends Controller
{

    public function __construct(private NiceVerifyService $verifyService)
    {
    }

    public function success(Request $request)
    {
        session()->put('NICE_PHONE_ENCODE_DATA', $request->get('EncodeData'));
        $result = $this->verifyService->getPhoneDecodeData(session('NICE_PHONE_ENCODE_DATA'));
        return view('core::nice-verify.success', compact('result'));
    }

    public function fail(Request $request)
    {
        return view('core::nice-verify.error');
    }
}
