<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Services\EmailService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\InteriorPageRequest;
use App\Http\Requests\WineStoreFormRequest;
use Modules\Core\Entities\PageMeta;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;
use Plank\Mediable\Media;

class PageSubmissionController extends Controller
{
    public function __construct(private EmailService $emailService)
    {
    }

    private static $custom_error_messages = [
        'g-recaptcha-response.required' => 'Please complete the reCAPTCHA to proceed.',
        'g-recaptcha-response.captcha'  => 'reCAPTCHA validation failed, please try again.',
    ];

    protected function submitInstructionForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'inquiry' => 'required',
            'term'    => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->phone}</p>" . PHP_EOL;
            $body .= "<p>이메일: {$request->email}</p>" . PHP_EOL;
            $body .= "<p>문의내용: {$request->inquiry}</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('term') ? 'Yes' : 'No') . "</p>" . PHP_EOL;

            $this->emailService->send('cs@businesshub.co.kr', "이용안내 및 문의", $body, $request->email);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    protected function submitHanbadaForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name'        => 'required',
            'business_number'      => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'consulting'           => 'sometimes|accepted',
            'terms_and_service1'   => 'sometimes|accepted',
            'terms_and_service2'   => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->business_name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->business_number}</p>" . PHP_EOL;
            $body .= "<p>일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>벤처투자 소득 공제 및 절세 프로그램: {$request->consulting}</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', "Skeeper", $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    protected function submitKneeStemForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'            => 'required',
            'contact'              => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'terms_and_service1'   => 'sometimes|accepted',
            'terms_and_service2'   => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->user_name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: Yes</p>" . PHP_EOL;
            $body .= "<p>일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', "무릎 줄기 세포", $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    protected function submitSafetyCoverForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'            => 'required',
            'contact'              => 'required',
            'business_name'        => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'terms_and_service1'   => 'sometimes|accepted',
            'terms_and_service2'   => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->user_name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>사업자명 or 기관명: {$request->business_name}</p>" . PHP_EOL;
            $body .= "<p>통화 가능 일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', "안전 덮개 (스틸 그레이팅) 상담신청", $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    protected function submitSkeeperForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'            => 'required',
            'contact'              => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'terms_and_service1'   => 'sometimes|accepted',
            'terms_and_service2'   => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->user_name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>사업자명 or 기관명: {$request->business_name}</p>" . PHP_EOL;
            $body .= "<p>통화 가능 일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', "안전 덮개 (스틸 그레이팅) 상담신청", $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    protected function submitBioTechForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'business_name'        => 'required',
            'contact'              => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'health_anti_aging'    => 'sometimes|accepted',
            'disease_treatment'    => 'sometimes|accepted',
            'beauty_care'          => 'sometimes|accepted',
            'others'               => 'sometimes|accepted',
            'terms_and_service1'   => 'sometimes|accepted',
            'terms_and_service2'   => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>성명: {$request->business_name}</p>" . PHP_EOL;
            $body .= "<p>연락처: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>통화 가능 일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>건강/항노화: " . ($request->has('health_anti_aging') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>질병/치료: " . ($request->has('disease_treatment') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>미용/뷰티: " . ($request->has('beauty_care') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>기타: " . ($request->has('others') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', $request->business_name, $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    protected function submitRentalForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'                 => 'required',
            'contact'              => 'required',
            'business_number'      => 'required',
            'representative_name'  => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'terms_and_service1'   => 'sometimes|accepted',
            'terms_and_service2'   => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>성명: {$request->name}</p>" . PHP_EOL;
            $body .= "<p>연락처: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>사업체명: {$request->representative_name}</p>" . PHP_EOL;
            $body .= "<p>업종: {$request->business_number}</p>" . PHP_EOL;
            $body .= "<p>일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', $request->name, $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    protected function submitInquiryForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name'                 => 'required',
            'contact_email'                => 'required|email',
            'contact_person_name_position' => 'required',
            'company_registration_number'  => 'required',
            'contact_phone_number'         => 'required',
            'inquiry'                      => '',
            'terms_and_service1'           => 'sometimes|accepted',
            'terms_and_service2'           => 'sometimes|accepted',
            recaptchaFieldName()           => recaptchaRuleName(),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= "<p>성명: {$request->contact_person_name_position}</p>" . PHP_EOL;
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>연락처: {$request->contact_phone_number}</p>" . PHP_EOL;
            $body .= "<p>이메일: {$request->contact_email}</p>" . PHP_EOL;
            $body .= "<p>문의내용: {$request->inquiry}</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', $request->contact_person_name_position, $body, $request->contact_email);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    protected function submitAutoContactForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name'        => 'required',
            'customer_phone'       => 'required',
            'product'              => 'required',
            'terms_and_service'    => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->customer_name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->customer_phone}</p>" . PHP_EOL;
            $body .= "<p>상품 선택: {$request->product}</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service') ? 'Yes' : 'No') . "</p>" . PHP_EOL;

            $this->emailService->send('cs@businesshub.co.kr', $request->customer_name, $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    protected function submitWineStoreForm(WineStoreFormRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                 => 'required|string',
            'business_number'      => 'required',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>이름: {$request->name}</p>" . PHP_EOL;
            $body .= "<p>연락처: {$request->business_number}</p>" . PHP_EOL;
            $body .= "<p>일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_and_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', '와인창업 상담신청', $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    protected function BatteryFireForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                 => 'required',
            'contact'              => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'terms_1'              => 'sometimes|accepted',
            'terms_2'              => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('terms_2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', $request->name, $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    protected function InteriorPageForm(InteriorPageRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                 => 'required',
            'contact'              => 'required',
            'organisation'         => 'required',
            'condition1'           => 'sometimes|accepted',
            'condition2'           => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>사업장 or 기관명: {$request->organisation}</p>" . PHP_EOL;
            $body .= "<p>일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('condition1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('condition2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', '인테리어', $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    protected function submitAutomaticFireExtinguisherForm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name'            => 'required',
            'contact'              => 'required',
            'business_name'        => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'term_service1'        => 'sometimes|accepted',
            'term_service2'        => 'sometimes|accepted',
            'g-recaptcha-response' => 'required',
        ], self::$custom_error_messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>고객명: {$request->user_name}</p>" . PHP_EOL;
            $body .= "<p>휴대전화: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>통화 가능 일시: {$request->available_call_year}년 {$request->available_call_month}월 {$request->available_call_day}일 {$request->available_call_hour}시</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('term_service1') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $body .= "<p>위 개인정보 수집, 이용에 동의합니다: " . ($request->has('term_service2') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', $request->user_name, $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }

    public function recruitmentRepSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'           => 'required',
            'name'               => 'required',
            'contact'            => 'required',
            'contact_email'      => 'required',
            'inquiry'            => 'required',
            'term'               => 'sometimes|accepted',
            recaptchaFieldName() => recaptchaRuleName(),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $body = '';
            $body .= $this->includeBhId($body, $request);
            $body .= "<p>모집구분: {$request->category}</p>" . PHP_EOL;
            $body .= "<p>성명: {$request->name}</p>" . PHP_EOL;
            $body .= "<p>연락처: {$request->contact}</p>" . PHP_EOL;
            $body .= "<p>이메일: {$request->contact_email}</p>" . PHP_EOL;
            $body .= "<p>내용: {$request->inquiry}</p>" . PHP_EOL;
            $body .= "<p>개인정보 수집 및 이용에 동의합니다: " . ($request->has('term') ? 'Yes' : 'No') . "</p>" . PHP_EOL;
            $this->emailService->send('cs@businesshub.co.kr', $request->category, $body);
            return redirect()->back()->with('success', '완료');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', '메일 전송 실패 !!!');
        }
    }


    private function includeBhId($body, Request $request)
    {
        $meta = PageMeta::where('page_url', strtok(url()->previous(), '?'))->first();
        if ($meta) {
            $collect = collect($meta->meta_information)->first(fn($value) => $value['property'] == 'og:title');
            if ($collect) {
                $body .= "<p>상품명: {$collect['content']}</p>" . PHP_EOL;
            }
        }
        if ($request->has('bhid')) {
            $user = User::where('code', $request->bhid)->first();
            if ($user) {
                $body .= "<p>영업사원 이름: {$user->first_name} {$user->last_name}</p>" . PHP_EOL;
                $body .= "<p>영업사원 코드: {$request->get('bhid')}</p>" . PHP_EOL;
            }
        }
        return $body;
    }

    public function getInitProducts()
    {

        $perPage = 10;
        $orderDir = 'asc';

        // === OLD STARTS ===

//        $products = Product::with('media')
//            ->orderByRaw("CASE WHEN exposer_order IS NULL THEN " . PHP_INT_MAX . " ELSE exposer_order END {$orderDir}")
//            ->paginate($perPage);

        // === OLD ENDS ===

        if (request()->ajax()) {

            $products = DB::table('products')
                ->join('mediables', 'mediables.mediable_id', '=', 'products.id')
                ->join('media', 'media.id', '=', 'mediables.media_id')
                ->select('products.product_name', 'products.url_1', 'products.product_description')
                ->selectRaw('CONCAT(media.filename, ".", media.extension) as banner')
                ->where([
                    ['mediables.tag', '=', 'banner'],
                    ['mediables.mediable_type', '=', Product::class],
                ])
                ->orderByRaw("CASE WHEN products.exposer_order IS NULL THEN " . PHP_INT_MAX . " ELSE products.exposer_order END {$orderDir}")
                ->paginate($perPage);

            return response()->json(['data' => $products]);
        }
    }

    private function getProductMediaPath(string $tag = "banner")
    {
        return env('APP_URL') . '/' . env('AWS_ROOT_DIR', '') . '/' . $tag . '/';

    }
}
