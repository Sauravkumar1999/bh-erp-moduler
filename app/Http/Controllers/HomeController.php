<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Services\SMSService;
use Modules\Core\Services\EmailService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Send SMS function
     *
     * @param [type] $number
     * @return void
     */
    protected function sendSMS($number, SMSService $sms)
    {
        $result = $sms->send($number, 'Hello, This is just a test Message');
        dd($result);
    }

    /**
     * Send Email function
     *
     * @param string $email
     * @param EmailService $emailService
     *
     * @return void
     */
    protected function sendEmail($email, EmailService $emailService)
    {
        $result = $emailService->send($email, 'Test Subject', 'Hello, This is just a test Message');
        dd($result);
    }

}
