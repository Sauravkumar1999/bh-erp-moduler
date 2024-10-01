<?php

namespace Modules\User\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Modules\Core\Services\SMSService;
use Modules\User\Entities\Contact;
use Modules\User\Entities\User;
use Modules\User\Events\UserLoggedOut;

class LoginController extends Controller
{

    /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private SMSService $sMSService)
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('user::auth.login');
    }

    public function logout(Request $request)
    {
        event(new UserLoggedOut(auth()->user()));

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            // 'token' => 'required|captcha'
        ]);
    }

    /**
     * @throws ValidationException
     */
    protected function authenticated(Request $request, $user)
    {
        if (!$user->status) {
            $this->logout($request);
            throw ValidationException::withMessages([
                'inactive' => [trans('user::authentication.inactive')],
            ]);
        }

        $user->last_login = Carbon::now();
        $user->update();
    }

    public function redirectTo(): string
    {
        return login_redirect_url();
    }

    protected function showFindPassword(Request $request)
    {
        return view('user::auth.find-password');
    }
    protected function resetPassword(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if($user){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => true]);
    }
    protected function showFindId(Request $request)
    {
        return view('user::auth.find-id');
    }
    public function sendOTP(Request $request)
    {
        try {
            $otp = mt_rand(100000, 999999);
            $message = '[비즈니스허브] 인증번호 [' . $otp . ']를 입력해주세요. 사칭/전화사기에 주의하세요.';
            $this->sMSService->send($request->phone_number, $message);
            Session::put('otp', $otp);
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            Session::forget('otp');
            return response()->json(['success' => false, 'response' => $th->getMessage()]);
        }
    }
    public function updatePhone(Request $request)
    {
        try {
            $phone_number = $request->phone_number;
            $user_id = $request->user_id;
            $user = Contact::where('user_id',$user_id)->first();
            if($user){
                $user->update([
                    'telephone_1' => $phone_number
                ]);
                return response()->json(['success' => true]);
            }
            return response()->json(['error' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'response' => $th->getMessage()]);
        }
    }
    public function verifyPhone(Request $request)
    {

        try {
            $phone_number = $request->phone_number;
            $email = $request->id;
            $name = $request->name;
            if (!$phone_number) {
                return response()->json(['error' => true]);
            }
            if ($request->type === 'find-password') {
                if (User::where('email', $email)->exists()) {
                    $userExits = User::where('email', $email)
                    ->where('first_name', $name)
                    ->whereHas('contacts', function ($query) use ($phone_number) {
                        $query->where('telephone_1', $phone_number);
                    })
                    ->first();
        
                    if ($userExits && $userExits->contacts->isNotEmpty()) {
                        $user = $userExits->contacts->first();
                    }
                }
            } else {
                if (Contact::where('telephone_1', $phone_number)->exists()) {
                    $userExits = User::where('first_name', $name)->whereHas('contacts', function ($query) use ($phone_number) {
                        $query->where('telephone_1', $phone_number);
                    })->first();
                    if ($userExits && $userExits->contacts->isNotEmpty()) {
                        $user = $userExits->contacts->first();
                    }
                }
            }

            if (isset($user)) {
                return response()->json(['success' => true]);
            }

            return response()->json(['error' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'response' => $th->getMessage()]);
        }
    }

    public function verifyOTP(Request $request)
    {
        if (Session::has('otp')) {
            $otp = Session::get('otp');
            $enteredOTP = $request->input('certification_number');
            if ($otp == $enteredOTP) {
                Session::forget('otp');
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }
    public function findUserId(Request $request)
    {
        $phone_number = $request->phone_number;
        $email = $request->id;
        $name = $request->name;
        try {
            $userData = User::select('email')->where('first_name', $name)->whereHas('contacts', function ($query) use ($request) {
                $query->where('telephone_1', $request->phone_number);
            })->withoutGlobalScopes()->get();
            if ($request->type == 'find-password') {
                $userData = User::where('email', $email)
                    ->where('first_name', $name)
                    ->whereHas('contacts', function ($query) use ($phone_number) {
                        $query->where('telephone_1', $phone_number);
                    })
                    ->first();
            }

            if ($userData) {
                return response()->json(['success' => true, 'data' => $userData]);
            }
            return response()->json(['success' => false, 'message' => 'Not found']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}
