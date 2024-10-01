<?php

namespace Modules\User\Http\Controllers;

use Modules\Core\Services\NiceVerifyService;
use Modules\User\Entities\Bank;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Modules\Media\Traits\MediaHandler;
use Illuminate\Support\Facades\Session;
use Modules\User\Events\UserCreated;
use Modules\User\Http\Requests\ReferralCode;
use Modules\User\Http\Requests\RegisterUser;
use Modules\User\Http\Requests\EmailAvailable;
use Modules\User\Http\Requests\PasswordVerify;
use Modules\User\Traits\UserSequenceManager;
use Modules\User\Services\UserService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Registration Controller
 *
 * @author Samar Haider <r.samar@mufin.co.kr>
 */
class RegistrationController extends Controller
{
    use MediaHandler, UserSequenceManager;

    public function index()
    {
        // if (auth()->user()) {
        //     return redirect()->route('home');
        // }
        $banks = Bank::whereStatus(1)->get();
        return view('user::auth.biz-planner-registration.index', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterUser $request Request User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RegisterUser $request, NiceVerifyService $niceVerifyService)
    {
        $request->validated();
        $user = new User();

        $user->first_name = $request->get('name');
        $user->email = $request->get('email');
        // $user->code = $this->getNextUserCode();

        //? Generate a unique code for the user based on their phone number
        // First, remove all non-numeric characters from the phone number
        $phone_number = preg_replace("/[^0-9]/", "", $request->get('phone'));
        
        // Check if a user with the same code
        $existingUser = User::withTrashed()->where('code', $phone_number)->first();

        // If an existing user is found and it's a soft-deleted record, force delete it
        if ($existingUser && $existingUser->trashed()) {
            $existingUser->forceDelete();
        }
        
        // Set the user's code to the last 8 digits of their phone number
        $user->code = $phone_number;

        $user->password = bcrypt($request->get('password'));
        $user->status = 0;

        if ($request->has('date_of_birth') && $request->filled('date_of_birth')) {
            $user->dob = $niceVerifyService->formatDOB($request->get('date_of_birth'));
        }

        if ($request->has('gender') && $request->filled('gender')) {
            $user->gender = $request->get('gender') == 1 ? 'male' : 'female';
        }

        if ($request->referral_code_verified) {
            $recommender = User::where('code', $request->referral_code_verified)->first();
            if ($recommender && $recommender->company_id) {
                $user->company_id = $recommender->company_id;
            }
        }

        $user->bank_id = $request->get('bank_name');
        $user->bank_account_no = $request->get('account_number');
        $user->save();

        $data = [
            'recommender'     => $request->get('referral_code'),
            'biz-planner-reg' => true
        ];

        event(new UserCreated($user, $data));

        $user->contacts()->create([

            'telephone_1'    => $request->get('phone'),
            // 'telephone_2'       => $request->get('phone'),
            'state'          => $request->get('state'),
            'post_code'      => $request->get('post_code'),
            'address'        => $request->get('address'),
            'address_detail' => $request->get('address_detail'),
        ]);
        if ($request->file('bankbook_photo')) {
            $media = $this->uploadBankbookImage($request->file('bankbook_photo'));
            $user->attachMedia($media, ['bankbook']);
        }
        if ($request->file('id_photo')) {
            $media = $this->uploadIdCardImage($request->file('id_photo'));
            $user->attachMedia($media, ['idCard']);
        }

        Session::flush();

        return response()->json('Registration success !');
    }

    /**
     * Check email is available
     *
     * @param EmailAvailable $request EmailAvailable Input
     *
     * @return string true|false
     */
    public function emailAvailable(EmailAvailable $request)
    {
        $request->validated();
        return 'true';
    }

    /**
     * Check referral code is valid
     *
     * @param ReferralCode $request ReferralCode Input
     *
     * @return \Illuminate\Http\JsonResponse true|false
     */
    public function verifyReferralCode(ReferralCode $request)
    {
        $validated_data = $request->validated();
        $user = User::where('code', $validated_data['referral_code'])->select('first_name', 'last_name', 'username')->first();
        if ($user) {
            return response()->json(['recommender' => $user], 200);
        }
        return response()->json([
            'errors' => [
                'referral_code' => ['존재하지 않는 추천인 코드입니다']
            ]
        ], 422);
    }

    /**
     * Check password is valid
     *
     * @param PasswordVerify $request PasswordVerify Input
     *
     * @return string true|false
     */
    public function verifyPassword(PasswordVerify $request)
    {
        $request->validated();
        return 'true';
    }

    
    /**
     * Import users from an Excel file
     *
     * @param Request $request
     * @param UserService $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function importUsers(Request $request, UserService $userService)
    {

        $file = $request->file('user_excel');

        if ($file && $file->isValid()) {
            // Get the original file name
            $fileName = $file->getClientOriginalName();

            // Define the directory where the file will be stored
            $directory = 'imports';

            // Move the uploaded file to the specified directory
            $file->move(storage_path('app/' . $directory), $fileName);

            // Get the full file path
            $fullFilePath = storage_path('app/' . $directory . '/' . $fileName);

            $data = $userService->importUsersFromExcel($fullFilePath);

            // Count the number of successful and failed records
            $successCount = count($data['success']);
            $errorCount = count($data['errors']);

            $data['message'] = "Number of records inserted: $successCount, Number of records failed: $errorCount";

            return response()->json(['details' => $data], 200);
        }

        return response()->json(['message' => 'Invalid file'], 400);
    }

    public function downloadTemplate()
    {
        $userService = new UserService();
        $template = $userService->generateUserTemplate();
        return Excel::download($template, 'template.xlsx');
    }
}
