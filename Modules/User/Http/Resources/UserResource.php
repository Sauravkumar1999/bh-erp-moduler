<?php


namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Entities\User;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'code'               => $this->code,
            'user_type'          => $this->user_type,
            'name'               => $this->full_name,
            'email'              => $this->email,
            'dob'                => $this->dob,
            'gender'             => $this->gender,
            'bank_account_no'    => $this->bank_account_no,
            'status'             => $this->status,
            'member_status'      => $this->member_status,
            'final_confirmation' => $this->final_confirmation->format('Y-m-d H:i A'),
            'company'            => $this->company?->name,
            'bank'               => $this->bank?->name,
            'created_at'         => $this->created_at->format('Y-m-d H:i A'),
            'referral_user'      => $this->getReferralUser($this->parent_id),
        ];
    }

    private function getReferralUser(mixed $parent_id)
    {
        if ($parent_id) {

            $refuser = User::find($parent_id);

            return $refuser ? [
                'code' => $refuser->code,
                'name' => $this->full_name,
            ] : [];

        }

        return [];
    }

}
