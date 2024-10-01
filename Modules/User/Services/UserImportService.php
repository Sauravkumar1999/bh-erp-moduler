<?php

namespace Modules\User\Services;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\User;
use Modules\User\Events\UserCreated;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UserImportService implements ToModel, WithHeadingRow
{
    protected $Log;

    public function __construct(&$Log)
    {
        $this->Log = &$Log;
    }

    public function model(array $row)
    {
        // Convert float values to integers
        $row['status'] = (int) $row['status'];
        $row['company'] = (int) $row['company'];
        $row['user_role'] = (int) $row['user_role'];
        $row['contact'] = (int) $row['contact'];

        // Convert date values to proper format
        $row['date_of_birth'] = $this->convertExcelDate($row['date_of_birth']);
        $row['registration_final_confirmation'] = $this->convertExcelDate($row['registration_final_confirmation']);
        $row['royal_member_application_date'] = $this->convertExcelDate($row['royal_member_application_date']);
        $row['user_start_date'] = $this->convertExcelDate($row['user_start_date']);
        $row['user_end_date'] = $this->convertExcelDate($row['user_end_date']);
        $row['royal_member_deposite_date'] = $this->convertExcelDate($row['royal_member_deposite_date']);

        $validator = Validator::make($row, [
            'user_type' => 'required|in:member,agency',
            'company' => 'required|integer',
            'user_role' => 'required|integer',
            'name' => 'required',
            'contact' => 'required',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'nullable',
            'registration_final_confirmation' => 'nullable|date',
            'recommender' => 'nullable',
            'copy_of_id' => 'nullable|image',
            'copy_of_bankbook' => 'nullable|image',
            'royal_member_application_date' => 'nullable|date',
            'royal_member_deposite_date'=> 'nullable|date',
            'user_start_date'=> 'nullable|date',
            'user_end_date' => 'nullable|date',
            'royal_member_application' => 'required',
            'status' => 'nullable|in:0,1'
        ]);

        if ($validator->fails()) {
            // Log the validation errors for this row
            $this->Log['errors'][] = [
                'message' => $validator->errors()->all(),
                'row' => $row
            ];
        } else {
            // Insert the user and log success or failure
            try {
                $user = $this->insertUser($row);
                $this->Log['success'][] = [
                    'message' => 'Registration successful.',
                    'row' => $row
                ];
            } catch (\Exception $e) {
                $this->Log['errors'][] = [
                    'message' => $e->getMessage(),
                    'row' => $row
                ];
            }
        }
        
    }

    private function convertExcelDate($excelDate)
    {
        if (is_numeric($excelDate)) {
            return Date::excelToDateTimeObject($excelDate)->format('Y-m-d H:i:s');
        }

        return null;
    }

    private function insertUser($row)
    {
        // Create a new User instance
        $user = new User();

        // Set user attributes
        $user->first_name = $row['name'];
        $user->email = $row['email'];

        // Generate a unique code for the user based on their phone number
        $phone_number = preg_replace("/[^0-9]/", "", $row['contact']);
        $existingUser = User::withTrashed()->where('code', $phone_number)->first();
        if ($existingUser && $existingUser->trashed()) {
            $existingUser->forceDelete();
        }
        $user->code = $phone_number;

        $user->password = bcrypt($row['password']);
        $user->status = 0;

        // Handle date of birth
        if (isset($row['date_of_birth'])) {
            $user->dob = $row['date_of_birth'];
        }

        if(isset($row['registration_final_confirmation'])){
            $user->final_confirmation = $row['registration_final_confirmation'];
        }

        if(isset($row['royal_member_deposite_date'])){
            $user->deposit_date = $row['royal_member_deposite_date'];
        }

        if(isset($row['royal_member_application_date'])){
            $user->submitted_date = $row['royal_member_application_date'];
        }

        if(isset($row['user_start_date'])){
            $user->start_date = $row['user_start_date'];
        }

        if(isset($row['user_end_date'])){
            $user->end_date = $row['user_end_date'];
        }

        // Handle gender
        if (isset($row['gender'])) {
            $user->gender = $row['gender'] == 'male' ? 'male' : 'female';
        }

        // Handle referral code
        if (isset($row['recommender'])) {
            $recommender = User::where('code', $row['recommender'])->first();
            if ($recommender && $recommender->company_id) {
                $user->company_id = $recommender->company_id;
            }
        }

        // Save the user to the database
        $user->save();

        // Emit event
        $data = [
            'recommender'     => $row['recommender'],
            'biz-planner-reg' => true
        ];
        event(new UserCreated($user, $data));

        // Create user contacts
        $user->contacts()->create([
            'telephone_1'    => $row['contact'],
            'address'        => $row['address'],
        ]);

        // Return the created user instance
        return $user;
    }
}
